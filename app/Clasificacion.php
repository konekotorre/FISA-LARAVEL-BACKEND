<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'cuota_anual',
        'temporada_cuota'
    ];

    public function informacionFinanciera()
    {
        return $this->hasMany('App\Organizacion');
    }
}
