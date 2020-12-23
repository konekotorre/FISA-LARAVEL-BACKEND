<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regimen extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
    ];


    public function InformacionFinancieras()
    {
        return $this->hasMany('App\InformacionFinanciera');
    }

}
