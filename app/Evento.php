<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sessao;

class Evento extends Model
{
    protected $fillable = ['nome', 'slug'];

    public function sessao() 
    {
        return $this->belongsTo(Sessao::class, 'id', 'evento_id');
    }
}
