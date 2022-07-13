<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Evento;
use App\Inscrito;

class Sessao extends Model
{
    protected $fillable=['dia', 'evento_id'];

    public function evento(){
    	return $this ->belongsTo(Evento::class);
    }

    public function inscritos(){
        return $this->belongsToMany(Inscrito::class,"inscrito_sessao")->withPivot('checkin');;
    }

    public function countAllInscritosWithAcompanhantes($day)
    {
        $amount = 0;
        $sessao = Sessao::where('dia', $day)->first();

        if (!$this->inscritos->count()) {
            return $amount;
        }

        $amount = $this->inscritos->reduce(function($acc, $item) use ($sessao) {
            $acc += 1 + $item->acompanhante()->wherePivot('sessao_id', $sessao->id)->count();
            return $acc;
        }, 0);

        return $amount;
    }
}
