<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    protected $fillable = [

    'nombre',
    'tipo_documento_organizacion_id',
    'numero_documento',
    'razon_social',
    'categoria_id',
    'pagina_web',
    'pais_id',
    'tipo_organizacion_id',
    'clase_id',
    'sector_id',
    'subsector_id',
    'importaciones',
    'exportaciones',
    'motivo_afiliacion',
    'fecha_afiliacion',
    'fecha_desafiliacion',
    'fecha_edicion',
    'motivo_desafiliacion',
    'empleados_directos',
    'empleados_indirectos',
    'observaciones',
    'estado',
    'usuario_creacion',
    'usuario_actualizacion'

    ];

    public function clase()
    {
        return $this->belongsTo('App\Clase', 'clase_id', 'id');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id', 'id');
    }

    public function tipo()
    {
        return $this->belongsTo('App\TipoOrganizacion', 'tipo_organizacion_id', 'id');
    }

    public function pais()
    {
        return $this->belongsTo('App\Pais', 'pais_id', 'id');
    }

    public function sector()
    {
        return $this->belongsTo('App\Sector', "sector_id", 'id' );
    }

    public function documento()
    {
        return $this->belongsTo('App\TipoDocumentoOrganizacion', 'tipo_documento_organizacion_id', 'id');
    }

    public function subsector()
    {
        return $this->belongsTo('App\Subsector', 'subsector_id', 'id');
    }
    public function creacion()
    {
        return $this->belongsTo('App\User', 'usuario_creacion', 'id');
    }

    public function actualizacion()
    {
        return $this->belongsTo('App\User', 'usuario_actualizacion', 'id');
    }

    public function actividadesEconomicas()
    {
        return $this->hasMany('App\DetalleActividadEconomica');
    }

    public function importaciones()
    {
        return $this->hasMany('App\importaciones');
    }

    public function exportaciones()
    {
        return $this->hasMany('App\Exportaciones');
    }


    public function oficinas()
    {
        return $this->hasMany('App\Oficina');
    }

    public function contactos()
    {
        return $this->hasMany('App\Contacto');
    }

    public function archivos()
    {
        return $this->hasMany('App\Archivo');
    }

    public function informacionFinancieras()
    {
        return $this->hasOne('App\InformacionFinanciera');
    }

    public function visitas()
    {
        return $this->hasMany('App\Visita');
    }
}
