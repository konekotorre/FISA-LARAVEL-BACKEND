<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciiu extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo',
    ];

    public function actividadesEconomicas()
    {
        return $this->hasMany('App\DetalleActividadEconomica');
    }

}
