<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleCategoriaContacto extends Model
{
    protected $fillable = [
        'contacto_id',
        'subcategoria_id',
        ];

        public function contacto()
        {
            return $this->belongsTo('App\Contacto', 'contacto_id', 'id');
        }
        public function subcategoria()
        {
            return $this->belongsTo('App\Subcategoria', 'subcategoria_id', 'id');
        }

}
