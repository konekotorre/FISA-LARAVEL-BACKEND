<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCategoriaPersona extends Model
{
    protected $fillable = [
        'persona_id',
        'subcategoria_id',
    ];

    public function persona()
    {
        return $this->belongsTo('App\Persona', 'persona_id', 'id');
    }
    public function subcategoria()
    {
        return $this->belongsTo('App\Subcategoria', 'subcategoria_id', 'id');
    }
}
