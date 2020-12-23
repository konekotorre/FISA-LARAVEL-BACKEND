<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoOficina extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function oficinas()
    {
        return $this->hasMany('App\Oficina');
    }
}
