<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $fillable = [
        'nombre',
    ];

    public function sexoPersonas()
    {
        return $this->hasMany('App\Personas');
    }

}
