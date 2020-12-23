<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function CategoriaContactos()
    {
        return $this->hasMany('App\DetalleCategoriaContacto');
    }
}
