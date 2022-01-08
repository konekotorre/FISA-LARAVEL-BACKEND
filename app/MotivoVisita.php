<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MotivoVisita extends Model
{
    protected $fillable = [
        'nombre'
    ];


    public function Visitas()
    {
        return $this->hasMany('App\Visita');
    }
}
