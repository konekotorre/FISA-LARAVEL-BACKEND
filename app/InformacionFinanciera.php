<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformacionFinanciera extends Model
{
    protected $fillable = [
        'organizacion_id',
        'ingresos_anuales',
        'egresos_anuales',
        'ingresos_operacionales',
        'egresos_operacionales',
        'ingresos_no_operacionales',
        'egresos_no_operacionales',
        'ventas_anuales',
        'total_activos',
        'total_pasivos',
        'patrimonio_total',
        'total_exportaciones',
        'regimen_id',
        'temporada_declaracion',
        'clasificacion_id',
        'temporada_cuota',
        'cuota_anual',
        'cuota_real_pagada',
        'cuota_sostenimiento_real_pagada',
        'cuota_pautas',
        'fecha_fundacion',
        'estado',
        'usuario_creacion',
        'usuario_actualizacion'
    ];

    public function organizacion()
    {
        return $this->belongsTo('App\Organizacion', 'organizacion_id', 'id');
    }

    public function regimen()
    {
        return $this->belongsTo('App\Regimen', 'regimen_id', 'id');
    }

    public function clasificacion()
    {
        return $this->belongsTo('App\Clasificacion', 'clasificacion_id', 'id');
    }

    public function creacion()
    {
        return $this->belongsTo('App\User', 'usuario_creacion', 'id');
    }

    public function actualizacion()
    {
        return $this->belongsTo('App\User', 'usuario_actualizacion', 'id');
    }
}
