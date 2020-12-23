<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exportaciones extends Model
{
    protected $fillable = [
        'organizacion_id',
        'pais_id',
    ];

    public function pais()
    {
        return $this->belongsTo('App\Pais', 'pais_id', 'id');
    }

    public function organizacion()
    {
        return $this->belongsTo('App\Organizacion', 'organizacion_id', 'id');
    }
}