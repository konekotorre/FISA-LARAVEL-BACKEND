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
        'cuota_real_pagada',
        'cuota_unica_ingreso',
        'cuota_pautas',
        'fecha_edicion_pauta',
        'pendiente_facturacion',
        'fecha_fundacion',
        'estado',
        'importa',
        'exporta',
        'usuario_creacion',
        'usuario_actualizacion',
        'fecha_constitucion'
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
