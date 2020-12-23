<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConBusquedaExport implements FromCollection, WithHeadings
{

    function __construct($solicitud)
    {
        $this->ids = $solicitud['ids'];
    }

    public function collection()
    {
        $contacto_busqueda = DB::table('contactos')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'contactos.organizacion_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->leftJoin('oficinas', 'oficinas.id', 'contactos.oficina_id')
            ->leftJoin('ciudads', 'ciudads.id', '=', 'oficinas.ciudad_id')
            ->leftJoin('tipo_documento_personas', 'tipo_documento_personas.id', 'contactos.tipo_documento_persona_id')
            ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_actualizacion')
            ->select(
                'categorias.nombre as categoria',
                'organizacions.nombre as nombre_comercial',
                'organizacions.razon_social',
                'contactos.nombres',
                'contactos.cargo',
                'contactos.representante',
                'contactos.telefono',
                'contactos.celular',
                'contactos.email',
                'tipo_documento_personas.nombre as tipo_doc',
                'contactos.numero_documento',
                'oficinas.telefono_1',
                'oficinas.direccion',
                'contactos.id',
                'ciudads.nombre as ciudad',
                'contactos.sexo',
                'contactos.observaciones',
                'contactos.updated_at',
                'users.usuario'
            )
            ->distinct('contactos.created_at')
            ->whereIn('contactos.id', $this->ids)
            ->orderByDesc('contactos.created_at')
            ->get();

        $count = count($contacto_busqueda);

        for ($i = 0; $i < $count; $i++) {

            $id_bus =  $contacto_busqueda[$i]->id;

            $categorias = DB::table('detalle_categoria_contactos')
                ->leftJoin('subcategorias', 'subcategorias.id', '=', 'detalle_categoria_contactos.subcategoria_id')
                ->select('subcategorias.nombre')
                ->where('detalle_categoria_contactos.contacto_id', '=', $id_bus)
                ->get();

            $apellido = DB::table('contactos')
                ->select('contactos.apellidos')
                ->where('contactos.id', '=', $id_bus)
                ->get();

            $categoria = $categorias->pluck('nombre');
            $sal_cat = $categoria->toArray();
            $sal_categorias = implode(", ", $sal_cat);

            $apellidos = $apellido->pluck('apellidos');
            $nombres = $contacto_busqueda[$i]->nombres;
            $contacto = $nombres . " " . $apellidos[0];

            if ($contacto_busqueda[$i]->representante == true) {
                $contacto_busqueda[$i]->representante = "Si";
            } else {
                $contacto_busqueda[$i]->representante = "No";
            }

            $contacto_busqueda[$i]->id = $sal_categorias;
            $contacto_busqueda[$i]->nombres = $contacto;
        }

        return $contacto_busqueda;
    }

    public function headings(): array
    {
        return [
            'Categoria',
            'Nombre Comercial',
            'Razón Social',
            'Nombres',
            'Cargo',
            'Rep. Legal',
            'Telefono',
            'Celular',
            'Email',
            'Tipo Doc.',
            'Número Doc.',
            'Tel. Oficina',
            'Dir. Oficina',
            'Subcategorias',
            'Ciudad',
            'Genero',
            'Observaciones',
            'Última Actualización',
            'Último Editor'
        ];
    }
}
