<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [

        'organizacion_id',
        'oficina_id',
        'persona_id',
        'representante',
        'cargo',
        'telefono',
        'extension',
        'email',
        'email_2',
        'control_informacion',
        'envio_informacion',
        'observaciones',
        'estado',
        'usuario_creacion',
        'usuario_actualizacion'

    ];


    public function oficina()
    {
        return $this->belongsTo('App\Oficina', 'oficina_id', 'id');
    }

    public function organizacion()
    {
        return $this->belongsTo('App\Organizacion', 'organizacion_id', 'id');
    }

    public function persona()
    {
        return $this->belongsTo('App\Persona', 'persona_id', 'id');
    }

    public function creacion()
    {
        return $this->belongsTo('App\User', 'usuario_creacion', 'id');
    }

    public function actualizacion()
    {
        return $this->belongsTo('App\User', 'usuario_actualizacion', 'id');
    }

    public function visitas()
    {
        return $this->hasMany('App\Visita');
    }
}
