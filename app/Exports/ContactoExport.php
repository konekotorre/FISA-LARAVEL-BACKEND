<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactoExport implements FromCollection, WithHeadings
{

    function __construct($request)
    {
        $this->fecha_inicio = $request->fecha_inicio;
        $this->fecha_fin = $request->fecha_fin;
    }


    public function collection()
    {
        $contacto_busqueda = DB::table('contactos')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'contactos.organizacion_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->leftJoin('oficinas', 'oficinas.id', 'contactos.oficina_id')
            ->leftJoin('ciudads', 'ciudads.id', '=', 'oficinas.ciudad_id')
            ->leftJoin('tipo_documento_personas', 'tipo_documento_personas.id', 'personas.tipo_documento_persona_id')
            ->leftJoin('users', 'users.id', '=', 'organizacions.usuario_actualizacion')
            ->select(
                'categorias.nombre as categoria',
                'organizacions.nombre as nombre_comercial',
                'organizacions.razon_social',
                'personas.nombres',
                'contactos.cargo',
                'contactos.representante',
                'contactos.telefono',
                'contactos.extension',
                'personas.celular',
                'contactos.email',
                'tipo_documento_personas.nombre as tipo_doc',
                'personas.numero_documento',
                'oficinas.telefono_1',
                'oficinas.direccion',
                'personas.id as persona_id',
                'ciudads.nombre as ciudad',
                'personas.sexo',
                'contactos.observaciones',
                'contactos.created_at',
                'contactos.updated_at',
                'users.usuario'
            )
            ->distinct('contactos.updated_at')
            ->where([
                ['contactos.updated_at', '>=', $this->fecha_inicio],
                ['contactos.updated_at', '<=', $this->fecha_fin]
            ])
            ->orderByDesc('contactos.updated_at')
            ->get();

        $count = count($contacto_busqueda);

        for ($i = 0; $i < $count; $i++) {

            $id_bus =  $contacto_busqueda[$i]->persona_id;

            $categorias = DB::table('detalle_categoria_personas')
                ->leftJoin('subcategorias', 'subcategorias.id', '=', 'detalle_categoria_personas.subcategoria_id')
                ->select('subcategorias.nombre')
                ->where('detalle_categoria_personas.persona_id', '=', $id_bus)
                ->get();

            $apellido = DB::table('personas')
                ->select('personas.apellidos')
                ->where('personas.id', '=', $id_bus)
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

            $contacto_busqueda[$i]->persona_id = $sal_categorias;
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
            'Ext.',
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
            'Fecha Creación',
            'Última Actualización',
            'Último Editor'
        ];
    }
}
