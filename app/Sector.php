<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function Subsectors()
    {
        return $this->hasMany('App\Subsector');
    }

    public function Organizacions()
    {
        return $this->hasMany('App\Organizacion');
    }
}
