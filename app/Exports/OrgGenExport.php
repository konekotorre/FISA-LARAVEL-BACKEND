<?php

namespace App\Exports;

use DateTime;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrgGenExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    public function collection()
    {
        ini_set('memory_limit', '256M');
        $organizacion_busqueda = DB::table('organizacions')
            ->leftJoin('tipo_organizacions', 'tipo_organizacions.id', '=', 'organizacions.tipo_organizacion_id')
            ->leftJoin('tipo_documento_organizacions', 'tipo_documento_organizacions.id', '=', 'organizacions.tipo_documento_organizacion_id')
            ->leftJoin('subsectors', 'subsectors.id', '=', 'organizacions.subsector_id')
            ->leftJoin('sectors', 'sectors.id', '=', 'organizacions.sector_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->leftJoin('pais', 'pais.id', '=', 'organizacions.pais_id')
            ->leftJoin('clases', 'clases.id', '=', 'organizacions.clase_id')
            ->leftJoin('informacion_financieras', 'informacion_financieras.organizacion_id', '=', 'organizacions.id')
            ->leftJoin('clasificacions', 'clasificacions.id', '=', 'informacion_financieras.clasificacion_id')
            ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_creacion')
            ->select(
                'categorias.nombre as categoria',
                'tipo_documento_organizacions.nombre as tipo_doc',
                'organizacions.numero_documento',
                'tipo_organizacions.nombre as tipo',
                'organizacions.nombre as nombre_comercial',
                'organizacions.razon_social',
                'clases.nombre as clase',
                'pais.nombre as pais',
                'organizacions.id as departamento',
                'clasificacions.nombre as clasificacion',
                'clasificacions.cuota_anual',
                'clasificacions.temporada_cuota',
                'informacion_financieras.cuota_real_pagada',
                'informacion_financieras.cuota_unica_ingreso',
                'informacion_financieras.pendiente_facturacion',
                'informacion_financieras.cuota_pautas',
                'informacion_financieras.fecha_edicion_pauta as fecha_pauta',
                'informacion_financieras.total_activos',
                'informacion_financieras.temporada_declaracion',
                'informacion_financieras.fecha_constitucion',
                'organizacions.empleados_indirectos',
                'organizacions.estado',
                'sectors.nombre as sector',
                'subsectors.nombre as subsector',
                'organizacions.id',
                'informacion_financieras.exporta',
                'organizacions.id as expo',
                'informacion_financieras.importa',
                'organizacions.id as impo',
                'organizacions.pagina_web',
                'organizacions.observaciones',
                'organizacions.fecha_afiliacion',
                'organizacions.motivo_afiliacion',
                'organizacions.fecha_desafiliacion',
                'organizacions.motivo_desafiliacion',
                'organizacions.created_at',
                'users.usuario',
                'organizacions.updated_at',
                'users.usuario as editor'
            )
            ->orderByDesc('organizacions.created_at')
            ->get();
        $count = count($organizacion_busqueda);
        for ($i = 0; $i < $count; $i++) {
            $id_bus =  $organizacion_busqueda[$i]->id;
            $oficinas = DB::table('oficinas')
                ->leftJoin('tipo_oficinas', 'tipo_oficinas.id', '=', 'oficinas.tipo_oficina_id')
                ->join('ciudads', 'ciudads.id', '=', 'oficinas.ciudad_id')
                ->join('departamento_estados', 'departamento_estados.id', 'oficinas.departamento_estado_id')
                ->select(
                    'tipo_oficinas.nombre',
                    'oficinas.direccion',
                    'ciudads.nombre as ciudad',
                    'departamento_estados.nombre as estado'
                )
                ->where('oficinas.organizacion_id', '=', $id_bus)
                ->orderBy('tipo_oficinas.nombre')
                ->get();
            if (!$oficinas->isEmpty() && $i < $count) {
                $oficina_nom = $oficinas->pluck('nombre')->toArray();
                $oficina_dir = $oficinas->pluck('direccion')->toArray();
                $oficina_ciudad = $oficinas->pluck('ciudad')->toArray();
                $oficina_estado = $oficinas->pluck('estado')->toArray();
                $cn = count($oficinas);
                $array = array();
                for ($j = 0; $j < $cn; $j++) {
                    $array[$j] = $oficina_nom[$j] . ":" . $oficina_dir[$j] .
                        " (" . $oficina_ciudad[$j] . "," . $oficina_estado[$j] . ")";
                }
                $sal_oficinas = implode(", ", $array);
            } else {
                $sal_oficinas = "";
            }
            $ciius = DB::table('detalle_actividad_economicas')
                ->leftJoin('ciius', 'ciius.id', '=', 'detalle_actividad_economicas.ciiu_id')
                ->select('ciius.nombre')
                ->where('detalle_actividad_economicas.organizacion_id', '=', $id_bus)
                ->get();
            $ciiu = $ciius->pluck('nombre');
            $sal_ciuu = $ciiu->toArray();
            $sal_actividad = implode(", ", $sal_ciuu);
            $importaciones = DB::table('importaciones')
                ->leftJoin('pais', 'pais.id', '=', 'importaciones.pais_id')
                ->select('pais.nombre as pais_impo')
                ->where('importaciones.organizacion_id', '=', $id_bus)
                ->get();
            $importa = $importaciones->pluck('pais_impo');
            $sal_importa = $importa->toArray();
            $sal_imp_pais = implode(", ", $sal_importa);
            $exportaciones = DB::table('exportaciones')
                ->leftJoin('pais', 'pais.id', '=', 'exportaciones.pais_id')
                ->select('pais.nombre as pais_expo')
                ->where('exportaciones.organizacion_id', '=', $id_bus)
                ->get();
            $exportacion = $exportaciones->pluck('pais_expo');
            $sal_exporta = $exportacion->toArray();
            $sal_exp_pais = implode(", ", $sal_exporta);
            $departamento =  DB::table('departamento_estados')
                ->leftJoin('oficinas', 'oficinas.departamento_estado_id', '=', 'departamento_estados.id')
                ->join('tipo_oficinas', 'tipo_oficinas.id', '=', 'oficinas.tipo_oficina_id')
                ->select('departamento_estados.nombre as departamento')
                ->where('oficinas.organizacion_id', '=', $id_bus)
                //->where('tipo_oficinas.nombre', 'ilike', 'Principal')
                ->get();
            $dep = $departamento->pluck('departamento');
            $sal_dep = $dep->toArray();
            $sal_departamento = implode(", ", $sal_dep);
            $editor =  DB::table('users')
                ->join('organizacions', 'organizacions.usuario_actualizacion', '=', 'users.id')
                ->select('users.usuario as editor')
                ->where('organizacions.id', '=', $id_bus)
                ->get();
            $edit = $editor->pluck('editor');
            $sal_edit = $edit->toArray();
            $sal_editor = implode(", ", $sal_edit);
            $organizacion_busqueda[$i]->id = $sal_actividad;
            $organizacion_busqueda[$i]->expo = $sal_exp_pais;
            $organizacion_busqueda[$i]->impo = $sal_imp_pais;
            $organizacion_busqueda[$i]->empleados_indirectos = $sal_oficinas;
            $organizacion_busqueda[$i]->departamento = $sal_departamento;
            $organizacion_busqueda[$i]->editor = $sal_editor;
            $organizacion_busqueda[$i]->fecha_afiliacion = $organizacion_busqueda[$i]->fecha_afiliacion ? Date::dateTimeToExcel(new DateTime($organizacion_busqueda[$i]->fecha_afiliacion)): '';
            $organizacion_busqueda[$i]->fecha_desafiliacion = $organizacion_busqueda[$i]->fecha_desafiliacion ? Date::dateTimeToExcel(new DateTime($organizacion_busqueda[$i]->fecha_desafiliacion)): '';
            $organizacion_busqueda[$i]->fecha_constitucion = $organizacion_busqueda[$i]->fecha_constitucion ? Date::dateTimeToExcel(new DateTime($organizacion_busqueda[$i]->fecha_constitucion)): '';
            $organizacion_busqueda[$i]->fecha_pauta = $organizacion_busqueda[$i]->fecha_pauta ? Date::dateTimeToExcel(new DateTime($organizacion_busqueda[$i]->fecha_pauta)): '';
            $organizacion_busqueda[$i]->updated_at = $organizacion_busqueda[$i]->updated_at ? Date::dateTimeToExcel(new DateTime($organizacion_busqueda[$i]->updated_at)): '';
            $organizacion_busqueda[$i]->created_at = $organizacion_busqueda[$i]->created_at ? Date::dateTimeToExcel(new DateTime($organizacion_busqueda[$i]->created_at)): '';
            $organizacion_busqueda[$i]->estado === true ? $organizacion_busqueda[$i]->estado = "Activo" : $organizacion_busqueda[$i]->estado = "Inactivo";
            $organizacion_busqueda[$i]->importa === true ? $organizacion_busqueda[$i]->importa = "S" : null;
            $organizacion_busqueda[$i]->importa === false ? $organizacion_busqueda[$i]->importa = "N" : null;
            $organizacion_busqueda[$i]->exporta === true ? $organizacion_busqueda[$i]->exporta = "S" : null;
            $organizacion_busqueda[$i]->exporta === false ? $organizacion_busqueda[$i]->exporta = "N" : null;
        }
        return $organizacion_busqueda;
    }

    public function headings(): array
    {
        return [
            'Categoria',
            'Tipo de ID.',
            'Número Organización',
            'Tipo Organización',
            'Nombre Comercial',
            'Razón Social',
            'Clase Organización',
            'País',
            'Departamento',
            'Clasificación',
            'Cuota Anual',
            'Año Cuota',
            'Cuota Anual Pagada',
            'Cuota Única Ingreso',
            'Pendiente Facturación',
            'Cuota Pautas',
            'Fecha Edición Pauta',
            'Total Activos',
            'Fecha Activos',
            'Fecha Constitución',
            'Oficinas',
            'Estado',
            'Sector Económico',
            'Subsector',
            'CIIU Actividad Económica',
            'Exporta',
            'Exporta a',
            'Importa',
            'Importa de',
            'Página Web',
            'Observaciones',
            'Fecha Afiliación',
            'Motivo Afiliación',
            'Fecha Desafiliación',
            'Motivo Desafiliación',
            'Fecha Creación',
            'Usuario Creación',
            'Fecha Modificación',
            'Usuario Última Modificación'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'K' => NumberFormat::FORMAT_CURRENCY_USD,
            'M' => NumberFormat::FORMAT_CURRENCY_USD,
            'N' => NumberFormat::FORMAT_CURRENCY_USD,
            'Q' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'O' => NumberFormat::FORMAT_CURRENCY_USD,
            'R' => NumberFormat::FORMAT_CURRENCY_USD,
            'T' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AF' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AH' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AJ' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'AL' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
