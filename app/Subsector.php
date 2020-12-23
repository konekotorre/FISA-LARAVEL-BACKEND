<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsector extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'sector_id',
    ];

    public function sector()
    {
        return $this->belongsTo('App\Sector', 'sector_id', 'id');
    }

    public function organizaciones()
    {
        return $this->hasMany('App\Organizacion');
    }
}
