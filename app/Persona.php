<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = [

        'tipo_documento_persona_id',
        'numero_documento',
        'nombres',
        'apellidos',
        'sexo_id',
        'celular',
        'usuario_creacion',
        'usuario_actualizacion'
    ];

    public function documento()
    {
        return $this->belongsTo('App\TipoDocumentoPersona', 'tipo_documento_persona_id', 'id');
    }

    public function sexo()
    {
        return $this->belongsTo('App\Sexo', 'sexo_id', 'id');
    }

    public function creacion()
    {
        return $this->belongsTo('App\User', 'usuario_creacion', 'id');
    }

    public function actualizacion()
    {
        return $this->belongsTo('App\User', 'usuario_actualizacion', 'id');
    }

    public function categoriaContactos()
    {
        return $this->hasMany('App\DetalleCategoriaContacto');
    }
}
