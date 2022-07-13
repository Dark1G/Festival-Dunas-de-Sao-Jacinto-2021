<?php

namespace App\Http\Controllers;

use App\Acompanhante;
use Illuminate\Http\Request;
use App\Inscrito;
use App\Evento;
use App\Sessao;

class AdminController extends Controller
{
    public function index() 
    {
        $limit = env('EVENT_LIMIT');
        $concerto_x = Sessao::where("dia", 20)->first()->countAllInscritosWithAcompanhantes(20);
        $concerto_y = Sessao::where("dia", 21)->first()->countAllInscritosWithAcompanhantes(21);
        $concerto_z = Sessao::where("dia", 22)->first()->countAllInscritosWithAcompanhantes(22);

        $graphPie = collect([]);

        $eventos = Evento::all();
        foreach($eventos as $evento) {
            $all = $evento->sessao->countAllInscritosWithAcompanhantes($evento->sessao->dia);
            $countCheckinWithAcompanhate = $evento
                ->sessao
                ->inscritos()
                ->wherePivot('checkin', 1)
                ->get()
                ->reduce(function($acc, $inscrito) use ($evento) {
                $acc += 1 + $inscrito->acompanhante()->wherePivot('sessao_id', $evento->sessao->id)->count();
                return $acc;
            }, 0);

            $graphPie->push([
                'id' => $evento->slug,
                'title' => $evento->nome,
                'data' => [
                    $all, // Lotação
                    $countCheckinWithAcompanhate, // check-in
                    max($limit - $all, 0), // Vagas
                ]
            ]);
        }

        return view('admin.home', compact("concerto_x", "concerto_y", "concerto_z", "graphPie"));
    }

    public function inscritos($sessao, Request $request)
    {
        if (!$sessao) {
            return redirect()->route("admin");
        }

        $sessao = Sessao::where("dia", $sessao)->first();

        $inscritos = $sessao->inscritos;

        return view("admin.inscritos", compact("inscritos", "sessao"));
    }

    public function updateInscritos(Sessao $sessao, Inscrito $inscrito, Request $request)
    {
        $updated = $inscrito->sessao()->updateExistingPivot($sessao->id, ['checkin' => $request->checkin]);

        if (!$updated) {
            return ['error' => true, 'message' => 'Erro ao registar!'];
        }

        return ['error' => false, 'message' => 'Sucesso!'];
    }
}
