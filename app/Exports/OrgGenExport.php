<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrgGenExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $organizacion_busqueda = DB::table('organizacions')
            ->leftJoin('tipo_organizacions', 'tipo_organizacions.id', '=', 'organizacions.tipo_organizacion_id')
            ->leftJoin('tipo_documento_organizacions', 'tipo_documento_organizacions.id', '=', 'organizacions.tipo_documento_organizacion_id')
            ->leftJoin('subsectors', 'subsectors.id', '=', 'organizacions.subsector_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->leftJoin('pais', 'pais.id', '=', 'organizacions.pais_id')
            ->leftJoin('clases', 'clases.id', '=', 'organizacions.clase_id')
            ->leftJoin('informacion_financieras', 'informacion_financieras.organizacion_id', '=', 'organizacions.id')
            ->leftJoin('clasificacions', 'clasificacions.id', '=', 'informacion_financieras.clasificacion_id')
            ->leftJoin('importaciones', 'importaciones.organizacion_id', '=', 'organizacions.id')
            ->leftJoin('exportaciones', 'exportaciones.organizacion_id', '=', 'organizacions.id')
            ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_actualizacion')
            ->select(
                'categorias.nombre as categoria',
                'tipo_documento_organizacions.nombre as tipo_doc',
                'organizacions.numero_documento',
                'tipo_organizacions.nombre as tipo',
                'organizacions.nombre as nombre_comercial',
                'organizacions.razon_social',
                'pais.nombre as pais',
                'organizacions.estado',
                'clasificacions.nombre as clasificacion',
                'informacion_financieras.cuota_anual',
                'informacion_financieras.cuota_real_anual',
                'informacion_financieras.cuota_real_afiliacion',
                'exportaciones.id as expo',
                'importaciones.id as impo',
                'organizacions.observaciones',
                'subsectors.nombre as subsector',
                'organizacions.id',
                'clases.nombre as clase',
                'organizacions.pagina_web',
                'organizacions.fecha_afiliacion',
                'organizacions.motivo_afiliacion',
                'organizacions.fecha_desafiliacion',
                'organizacions.motivo_desafiliacion',
                'organizacions.updated_at',
                'users.usuario'
            )
            ->distinct('organizacions.created_at')
            ->orderByDesc('organizacions.created_at')
            ->get();

        $count = count($organizacion_busqueda);

        for ($i = 0; $i < $count; $i++) {
            $id_bus =  $organizacion_busqueda[$i]->id;

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

            $organizacion_busqueda[$i]->id = $sal_actividad;
            $organizacion_busqueda[$i]->expo = $sal_exp_pais;
            $organizacion_busqueda[$i]->impo = $sal_imp_pais;

            if ($organizacion_busqueda[$i]->estado == true) {
                $organizacion_busqueda[$i]->estado = "Activo";
            } else {
                $organizacion_busqueda[$i]->estado = "Inactivo";
            }
        }

        return $organizacion_busqueda;
    }

    public function headings(): array
    {
        return [
            'Categoria',
            'Tipo Doc.',
            'Numero',
            'Tipo',
            'Nombre Comercial',
            'Razón Social',
            'Pais',
            'Estado',
            'Clasificación',
            'Cuota Anual',
            'Cuota Real Anual',
            'Cuota Real Afiliación',
            'Exportaciones',
            'Importaciones',
            'Observaciones',
            'Subsector',
            'Actividades Económicas',
            'Clase',
            'Página Web',
            'Fecha Afiliación',
            'Motivo Afiliación',
            'Fecha Desafiliación',
            'Motivo Desafiliación',
            'Última Actualización',
            'Último Editor'
        ];
    }
}
