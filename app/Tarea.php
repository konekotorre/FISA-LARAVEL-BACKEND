<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = [
        'visita_id',
        'titulo',
        'descripcion',
        'resultado',
        'estado_id',
        'usuario_creacion',
        'usuario_actualizacion'
    ];

    public function visita()
    {
        return $this->belongsTo('App\Visita', 'visita_id', 'id');
    }
    
    public function estado()
    {
        return $this->belongsTo('App\EstadoTarea', 'estado_id', 'id');
    }
    public function creacion()
    {
        return $this->belongsTo('App\User', 'usuario_creacion', 'id');
    }

    public function actualizacion()
    {
        return $this->belongsTo('App\User', 'usuario_actualizacion', 'id');
    }
}
