<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    protected $fillable = [
        'organizacion_id',
        'direccion',
        'complemento_direccion',
        'tipo_oficina_id',
        'pais_id',
        'departamento_estado_id',
        'ciudad_id',
        'telefono_1',
        'telefono_2',
        'pbx',
        'estado',
        'usuario_creacion',
        'usuario_actualizacion'
    ];

    public function organizacion()
    {
        return $this->belongsTo('App\Organizacion', 'organizacion_id', 'id');
    }

    public function tipo()
    {
        return $this->belongsTo('App\TipoOficina', 'tipo_oficina_id', 'id');
    }

    public function pais()
    {
        return $this->belongsTo('App\pais', 'pais_id', 'id');
    }
    public function departamentoEstado()
    {
        return $this->belongsTo('App\DepartamentoEstado', 'departamento_estado_id', 'id');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad', 'ciudad_id', 'id');
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

    public function contactos()
    {
        return $this->hasMany('App\Contacto');
    }
}
