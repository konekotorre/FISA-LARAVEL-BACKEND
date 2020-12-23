<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [

        'organizacion_id',
        'tipo_documento_persona_id',
        'oficina_id',
        'numero_documento',
        'nombres',
        'apellidos',
        'sexo',
        'representante',
        'cargo',
        'telefono',
        'celular',
        'email',
        'observaciones',
        'estado',
        'usuario_creacion',
        'usuario_actualizacion'

    ];

    public function documento()
    {
        return $this->belongsTo('App\TipoDocumentoPersona', 'tipo_documento_persona_id', 'id');
    }

    public function oficina()
    {
        return $this->belongsTo('App\Oficina', 'oficina_id', 'id');
    }

    public function organizacion()
    {
        return $this->belongsTo('App\Organizacion', 'organizacion_id', 'id');
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

    public function categoriaContactos()
    {
        return $this->hasMany('App\DetalleCategoriaContacto');
    }

}
