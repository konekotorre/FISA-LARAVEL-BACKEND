<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoTarea extends Model
{
    protected $fillable = [
        'nombre'
    ];


    public function Tareas()
    {
        return $this->hasMany('App\Tarea');
    }
}
