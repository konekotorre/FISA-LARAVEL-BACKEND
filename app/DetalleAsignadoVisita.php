<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAsignadoVisita extends Model
{

    protected $fillable = [
        'asignado_id',
        'visita_id'
    ];

    public function asignado()
    {
        return $this->belongsTo('App\User', 'asignado_id', 'id');
    }

    public function visita()
    {
        return $this->belongsTo('App\Visita', 'visita_id', 'id');
    }
}
