<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    protected $fillable = [
        'organizacion_id',
        'contacto_id',
        'oficina_id',
        'fecha_programada',
        'fecha_ejecucion',
        'hora_inicio',
        'hora_fin',
        'titulo',
        'razon',
        'observaciones',
        'resultado',
        'usuario_asignado',
        'estado',
        'usuario_creacion',
        'usuario_actualizacion'
    ];

    public function creacion() {
        return $this->belongsTo('App\User', 'usuario_creacion', 'id');
    }

    public function actualizacion() {
        return $this->belongsTo('App\User', 'usuario_actualizacion', 'id');
    }

    public function asignado() {
        return $this->belongsTo('App\User', 'usuario_asignado', 'id');
    }

    public function organizacion() {
        return $this->belongsTo('App\Organizacion', 'organizacion_id', 'organizacion_id');
    }

    public function contacto() {
        return $this->belongsTo('App\Contacto', 'contacto_id', 'id');
    }

    public function oficina() {
        return $this->belongsTo('App\oficina', 'oficina_id', 'id');
    }

    public function tareas() {
        return $this->hasMany('App\Tareas');
    }
}
