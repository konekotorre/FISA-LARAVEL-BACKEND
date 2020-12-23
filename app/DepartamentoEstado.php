<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class DepartamentoEstado extends Model
{
    protected $fillable = [
        'nombre',
        'pais_id'
    ];

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    public function ciudad()
    {
        return $this->hasMany('App\Ciudad');
    }
}
