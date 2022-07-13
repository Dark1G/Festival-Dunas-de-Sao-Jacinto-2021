<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inscrito;
use App\Evento;
use App\Sessao;
use App\Acompanhante;
use App\Mail\NewSub;

class FormController extends Controller
{
	public $limit = 0;

	public function __construct() {
		$this->limit = (int) env('EVENT_LIMIT');
	}

    public function index($event, $day) 
	{
    	$evento = Evento::where("slug", $event)->first();
    	if (!isset($evento)) {
    		return redirect()->away("https://www.festivaldunassaojacinto.pt/");
		}

    	$exist_sessao = Sessao::where("dia", $day)->where("evento_id", $evento->id)->first();
    	if (!isset($exist_sessao)) {
    		return redirect()->away("https://www.festivaldunassaojacinto.pt/");
		}

		// $valid_sessao = $this->checkAllSessao($day, $evento);
		$valid_date = $this->validateDate($day);
		$limitInscritos = max($this->limit - $exist_sessao->countAllInscritosWithAcompanhantes($day), 0);

		$valid_sessao = $this->validateDate($day) && $limitInscritos > 0;
	
		$select_sessao = $this->getValidSessao($day, $evento->id, $evento->slug);

    	return view("form.index", compact("event","day", "evento", "select_sessao", "valid_sessao", "limitInscritos"));
    }
    
	public function store($event, $day, Request $request) 
	{

		if (!$this->validateDate($day)) {
			return ['error' => true, 'mensagem' => 'Inscrições encerradas para dia '.$day.'!'];
		}

    	$evento = Evento::where("slug", $event)->first();
    	if (!isset($evento)) {
    		return back();
    	}

    	$exist_sessao = Sessao::where("dia", $day)->where("evento_id", $evento->id)->first();
    	if (!isset($exist_sessao)) {
    		return back();
		}
		
		$this->validate($request, [
			'nome' => "required",
			'email' => "required|email",
			'documento_id' => "required"
		],[
			'nome.required' => "Campo obrigatório!",
			'email.required' => "Campo obrigatório!",
			'documento_id.required' => "Campo obrigatório!"
		]);

		if ($request->numero_acompanhante) {
			$this->validate($request, [
				'nome_acompanhante' => "required"
			], [
				'nome_acompanhante.required' => "Campo obrigatório!"
			]);
		}


		/* O Problema deve estar aqui */
		$sessao = Sessao::where('dia', $day)->first();
		if (isset($sessao->inscritos)) {
			if ($this->limit < ($sessao->countAllInscritosWithAcompanhantes($day) + 1 + $request->numero_acompanhante)) {
				return ['error' => true, 'mensagem' => 'Alcançado limite de inscritos para esta sessão!'];
			}
		}
		
		//FAZER ESTA VALIDAÇÃO - Feito acho eu!

		$user_exist = Inscrito::where("documento_id", $request->documento_id)->exists();
		if ($user_exist) {

			$user = Inscrito::where("documento_id", $request->documento_id)->first();
			$exist_user_event = $user->sessao()->where('evento_id', $evento->id)->first();
			if (isset($exist_user_event)) {
				return ['error' => true, 'mensagem' => 'Já está inscrito para o dia '.$exist_user_event->dia. ' para '.$exist_user_event->evento->nome.'. Lembramos que não se pode inscrever mais que uma vez para o mesmo dia.'];
			}

			$user->sessao()->attach($sessao->id);

			if (!empty($request->nome_acompanhante)) {
				$acompanhante = $this->saveAcompanhante($request->nome_acompanhante);

				if (!$acompanhante) {
					return ['error' => true, 'mensagem' => 'Ocorreu um erro ao fazer a sua inscrição!'];
				}

				$user->acompanhante()->attach($acompanhante->id, ['sessao_id' => $sessao->id]);
			}			

		} else {
			$user = Inscrito::create([
				'nome' => $request->nome,
				'documento_id' => $request->documento_id,
				'email' => $request->email
			]);
			
			if (!$user) {
				return ['error' => true, 'mensagem' => 'Ocorreu um erro ao fazer a sua inscrição!'];
			}

			$user->sessao()->attach($sessao->id);

			if (!empty($request->nome_acompanhante)) {
				$acompanhante = $this->saveAcompanhante($request->nome_acompanhante);

				if (!$acompanhante) {
					return ['error' => true, 'mensagem' => 'Ocorreu um erro ao fazer a sua inscrição!'];
				}

				$user->acompanhante()->attach($acompanhante->id, ['sessao_id' => $sessao->id]);
			}
		}

		//FAZER O ENVIO DO EMAIL (NOTIFY)
		\Mail::to($user->email)->send(new NewSub($user->nome, $sessao->horas, $evento->nome, $sessao->dia));
		return ['error' => false, 'mensagem' => 'Incrição feita com sucesso! Enviámos um email para o endereço email '.$user->email];
	}
	
	protected function getValidSessao($day, $evento_id, $evento){
		$temp = collect();
		$select_sessao = Sessao::where("dia", $day)->where("evento_id", $evento_id)->get();
		foreach ($select_sessao as $key => $sessao) {
			$sessao->valid = $sessao->inscritos->count() < $this->limit;
			$temp->push($sessao);
		}
		return $temp;
	}

	protected function checkAllSessao($day, $evento) {
		$all = Sessao::where('dia', $day)->where('evento_id', $evento->id)->get();
		$collection = collect();
		foreach ($all as $sessao) {
			$collection->push($this->limit <= $sessao->inscritos->count());
		}
		$arr = $collection->toArray();
		$valid = count(array_unique($arr)) === 1 && end($arr) === true;
		return $valid;
	}

	protected function saveAcompanhante($nome_acompanhante)
	{
		$acompanhante = Acompanhante::create([
			'nome' => $nome_acompanhante
		]);

		return $acompanhante;
	}

	protected function validateDate($day)
	{
		if ($day==20 || $day==21) {
			return (\Carbon\Carbon::now()
			->lessThan(\Carbon\Carbon::now()
			->year(2021)
			->month(8)
			->day($day)
			->hour(22)
			->minute(00)
			->second(00)));
		}
		return (\Carbon\Carbon::now()
			->lessThan(\Carbon\Carbon::now()
			->year(2021)
			->month(8)
			->day($day)
			->hour(16)
			->minute(30)
			->second(00)));
	}

}
