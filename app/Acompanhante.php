<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Inscrito;

class Acompanhante extends Model
{
    protected $fillable = ['nome'];

    public function inscrito()
    {
        return $this->belongsToMany(Inscrito::class, "inscrito_acompanhante");
    } 
    
}
