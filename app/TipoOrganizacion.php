<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOrganizacion extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function organizacions()
    {
        return $this->hasMany('App\Organizacion');
    }

}
