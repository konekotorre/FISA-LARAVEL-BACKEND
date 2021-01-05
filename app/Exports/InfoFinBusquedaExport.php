<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InfoFinBusquedaExport implements FromCollection, WithHeadings
{
    function __construct($solicitud)
    {
        $this->ids = $solicitud['ids'];
    }

    public function collection()
    {
        $contacto_busqueda = DB::table('informacion_financieras')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'informacion_financieras.organizacion_id')
            ->leftJoin('clasificacions', 'clasificacions.id', '=', 'informacion_financieras.clasificacion_id')
            ->leftJoin('regimens', 'regimen.id', 'informacion_financieras.regimen_id')
            ->leftJoin('users', 'users.id', '=', 'informacion_financieras.usuario_actualizacion')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->select(
                'categorias.nombre as categoria',
                'tipo_documento_organizacions.nombre as tipo_doc',
                'organizacions.numero_documento',
                'organizacions.nombre as nombre_comercial',
                'organizacions.razon_social',
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
                'regimens.nombre as regimen',
                'informacion_financieras.temporada_declaracion',
                'clasificacions.nombre as clasificacion',
                'informacion_financieras.temporada_cuota',
                'informacion_financieras.cuota_anual',
                'informacion_financieras.cuota_real_anual',
                'informacion_financieras.cuota_real_afiliacion',
                'informacion_financieras.created_at',
                'informacion_financieras.updated_at',
            )
            ->distinct('informacion_financieras.updated_at')
            ->whereIn('contactos.id', $this->ids)
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
            'Regimen',
            'Año Declaración',
            'Clasificación',
            'Año Cuota',
            'Cuota Anual',
            'Cuota Real Anual',
            'Cuota Real Afiliación',
            'Fecha Creación',
            'Última Actualización',
            'Último Editor'
        ];
    }
}
