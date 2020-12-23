<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{

    protected $fillable = [
        'organizacion_id',
        'nombre',
        'path',
        'tipo',
        'usuario_creacion'
    ];

    public function organizacion()
    {
        return $this->belongsTo('App\Organizacion', 'organizacion_id', 'id');
    }

    public function creacion()
    {
        return $this->belongsTo('App\User', 'usuario_creacion', 'id');
    }
}
