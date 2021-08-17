<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DateTime;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InfoFinGenExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
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
            $edicion = $info_busqueda[$i]->fecha_edicion_pauta ? new DateTime($info_busqueda[$i]->fecha_edicion_pauta):'';
            $created_at = new DateTime($info_busqueda[$i]->created_at);
            $updated_at = new DateTime($info_busqueda[$i]->updated_at);
            $info_busqueda[$i]->fecha_edicion_pauta = $info_busqueda[$i]->fecha_edicion_pauta ? $edicion->format('d/m/Y'): '';
            $info_busqueda[$i]->created_at = $created_at->format('d/m/Y');
            $info_busqueda[$i]->updated_at = $updated_at->format('d/m/Y');
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
            'Año Activos',
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

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_CURRENCY_USD,
            'H' => NumberFormat::FORMAT_CURRENCY_USD,
            'I' => NumberFormat::FORMAT_CURRENCY_USD,
            'J' => NumberFormat::FORMAT_CURRENCY_USD,
            'K' => NumberFormat::FORMAT_CURRENCY_USD,
            'L' => NumberFormat::FORMAT_CURRENCY_USD,
            'M' => NumberFormat::FORMAT_CURRENCY_USD,
            'N' => NumberFormat::FORMAT_CURRENCY_USD,
            'O' => NumberFormat::FORMAT_CURRENCY_USD,
            'Q' => NumberFormat::FORMAT_CURRENCY_USD,
            'W' => NumberFormat::FORMAT_CURRENCY_USD,
            'X' => NumberFormat::FORMAT_CURRENCY_USD,
            'Y' => NumberFormat::FORMAT_CURRENCY_USD,
            'Z' => NumberFormat::FORMAT_CURRENCY_USD,
            'AA' => NumberFormat::FORMAT_CURRENCY_USD,
            'AB' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AC' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AE' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['center' => true]
            ]
        ];
    }
}
