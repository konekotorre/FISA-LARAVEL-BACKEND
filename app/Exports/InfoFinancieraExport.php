<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InfoFinancieraExport implements FromCollection, WithHeadings
{

    function __construct($request)
    {
        $this->fecha_inicio = $request->fecha_inicio;
        $this->fecha_fin = $request->fecha_fin;
    }

    public function collection()
    {
        $info_busqueda = DB::table('informacion_financieras')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'informacion_financieras.organizacion_id')
            ->leftJoin('tipo_documento_organizacions', 'tipo_documento_organizacions.id', '=', 'organizacions.tipo_documento_organizacion_id')
            ->leftJoin('subsectors', 'subsectors.id', '=', 'organizacions.subsector_id')
            ->leftJoin('clasificacions', 'clasificacions.id', '=', 'informacion_financieras.clasificacion_id')
            ->leftJoin('regimens', 'regimens.id', '=', 'informacion_financieras.regimen_id')
            ->leftJoin('users', 'users.id', '=', 'informacion_financieras.usuario_actualizacion')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->select(
                'categorias.nombre as categoria',
                'tipo_documento_organizacions.nombre as tipo_doc',
                'organizacions.numero_documento',
                'organizacions.nombre as nombre_comercial',
                'organizacions.razon_social',
                'subsectors.nombre as subsector',
                'informacion_financieras.ingresos_anuales',
                'informacion_financieras.egresos_anuales',
                'informacion_financieras.ingresos_operacionales',
                'informacion_financieras.egresos_operacionales',
                'informacion_financieras.ingresos_no_operacionales',
                'informacion_financieras.egresos_no_operacionales',
                'informacion_financieras.ventas_anuales',
                'informacion_financieras.total_activos',
                'informacion_financieras.total_pasivos',
                'informacion_financieras.temporada_declaracion',
                'informacion_financieras.patrimonio_total',
                'organizacions.empleados_directos',
                'organizacions.empleados_indirectos',
                'regimens.nombre as regimen',
                'clasificacions.nombre as clasificacion',
                'clasificacions.temporada_cuota',
                'clasificacions.cuota_anual',
                'informacion_financieras.cuota_real_pagada',
                'informacion_financieras.cuota_unica_ingreso',
                'informacion_financieras.pendiente_facturacion',
                'informacion_financieras.cuota_pautas',
                'informacion_financieras.fecha_edicion_pauta',
                'informacion_financieras.created_at',
                'users.usuario',
                'informacion_financieras.updated_at',
                'informacion_financieras.id as id'
            )
            ->where([
                ['informacion_financieras.updated_at', '>=', $this->fecha_inicio],
                ['informacion_financieras.updated_at', '<=', $this->fecha_fin]
            ])
            ->orderByDesc('informacion_financieras.updated_at')
            ->get();

        $count = count($info_busqueda);

        for ($i = 0; $i < $count; $i++) {

            $id_bus = $info_busqueda[$i]->id;

            $editor =  DB::table('users')
                ->join('informacion_financieras', 'informacion_financieras.usuario_actualizacion', '=', 'users.id')
                ->select('users.usuario as editor')
                ->where('informacion_financieras.id', '=', $id_bus)
                ->get();

            $edit = $editor->pluck('editor');
            $sal_edit = $edit->toArray();
            $sal_editor = implode(", ", $sal_edit);

            $info_busqueda[$i]->id = $sal_editor;

            $created_at = date('d-m-Y', strtotime($info_busqueda[$i]->created_at));
            $updated_at = date('d-m-Y', strtotime($info_busqueda[$i]->updated_at));
            $info_busqueda[$i]->created_at =  $created_at;
            $info_busqueda[$i]->updated_at =  $updated_at;
            
        }
        return $info_busqueda;
    }

    public function headings(): array
    {
        return [
            'Categoria',
            'Tipo Doc.',
            'Numero',
            'Nombre Comercial',
            'Razón Social',
            'Subsector',
            'Ingresos Anuales',
            'Egresos Anuales',
            'Egresos Operacionales',
            'Ingresos Operacionales',
            'Ingresos no Operacionales',
            'Egresos no Operacionales',
            'Ventas Anuales',
            'Total Activos',
            'Total Pasivos',
            'Fecha Activos',
            'Patrimonio Total',
            'Emp. Directos',
            'Emp. Indirectos',
            'Regimen',
            'Clasificación',
            'Año Cuota',
            'Cuota Anual',
            'Cuota Anual Pagada',
            'Cuota Única Ingreso',
            'Pendiente Facturación',
            'Cuota Pautas',
            'Fecha Edición Pauta',
            'Fecha Creación',
            'Usuario Creación',
            'Fecha Modificación',
            'Usuario Última Modificación'
        ];
    }
}
