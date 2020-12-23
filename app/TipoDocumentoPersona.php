<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentoPersona extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function contactos()
    {
        return $this->hasMany('App\Contacto');
    }

}
