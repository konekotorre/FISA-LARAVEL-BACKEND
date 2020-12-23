<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $fillable = [
        'nombre',
    ];


    public function Departamentos()
    {
        return $this->hasMany('App\DepartamentoEstado');
    }

    public function Organizaciones()
    {
        return $this->hasMany('App\Organizacion');
    }

    public function Oficinas()
    {
        return $this->hasMany('App\Oficina');
    }
}
