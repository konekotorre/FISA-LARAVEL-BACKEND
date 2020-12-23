<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleActividadEconomica extends Model
{
    protected $fillable = [
        'organizacion_id',
        'ciiu_id',
    ];

    public function ciiu()
    {
        return $this->belongsTo('App\Ciiu', 'ciiu_id', 'id');
    }

    public function organizacion()
    {
        return $this->belongsTo('App\Organizacion', 'organizacion_id', 'id');
    }
}
