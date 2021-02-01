<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InfoFinGenExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $contacto_busqueda = DB::table('informacion_financieras')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'informacion_financieras.organizacion_id')
            ->leftJoin('tipo_documento_organizacions', 'tipo_documento_organizacions.id', '=', 'organizacions.tipo_documento_organizacion_id')
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
                'informacion_financieras.tota_activos',
                'informacion_financieras.total_pasivos',
                'informacion_financieras.patrimonio_total',
                'organizacions.empleados_directos',
                'organizacions.empleados_indirectos',
                'regimens.nombre as regimen',
                'informacion_financieras.temporada_declaracion',
                'clasificacions.nombre as clasificacion',
                'informacion_financieras.temporada_cuota',
                'informacion_financieras.cuota_anual',
                'informacion_financieras.cuota_real_pagada',
                'informacion_financieras.cuota_sostenimiento_real_pagada',
                'informacion_financieras.cuota_pautas',
                'informacion_financieras.created_at',
                'informacion_financieras.updated_at',
                'users.usuario'
            )
            ->distinct('informacion_financieras.updated_at')
            ->orderByDesc('informacion_financieras.updated_at')
            ->get();

        return $contacto_busqueda;
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
            'Patrimonio Total',
            'Emp. Directos',
            'Emp. Indirectos',
            'Regimen',
            'Año Declaración',
            'Clasificación',
            'Año Cuota',
            'Cuota Anual',
            'Cuota Real Pagada',
            'Cuota de Sostenimiento Real Pagada',
            'Cuota Pautas',
            'Fecha Creación',
            'Última Actualización',
            'Último Editor'
        ];
    }
}
