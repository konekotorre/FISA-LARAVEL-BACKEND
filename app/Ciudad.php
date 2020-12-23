<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $fillable = [
        'nombre',
        'departamento_estado_id',
    ];

    public function departamentoEstado()
    {
        return $this->belongsTo('App\DepartamentoEstado', 'departamento_estado_id', 'id');
    }

    public function oficinas()
    {
        return $this->hasMany('App\Oficina');
    }
}
