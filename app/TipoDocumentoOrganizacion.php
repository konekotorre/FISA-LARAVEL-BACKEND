<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentoOrganizacion extends Model
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
