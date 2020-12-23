<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function organizaciones()
    {
        return $this->hasMany('App\Organizacion');
    }

}
