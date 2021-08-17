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
class ContactoExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    function __construct($solicitud)
    {
        $this->ids = $solicitud['ids'];
    }

    public function collection()
    {
        $contacto_busqueda = DB::table('contactos')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->leftJoin('sexos', 'sexos.id', '=', 'personas.sexo_id')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'contactos.organizacion_id')
            ->leftJoin('categorias', 'categorias.id', '=', 'organizacions.categoria_id')
            ->leftJoin('oficinas', 'oficinas.id', 'contactos.oficina_id')
            ->leftJoin('departamento_estados', 'departamento_estados.id', '=', 'oficinas.departamento_estado_id')
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
                'contactos.email_2',
                'tipo_documento_personas.nombre as tipo_doc',
                'personas.numero_documento',
                'oficinas.direccion as dir',
                'personas.id as persona_id',
                'ciudads.nombre as ciudad',
                'departamento_estados.nombre as departamento',
                'sexos.nombre',
                'contactos.control_informacion as control',
                'contactos.envio_informacion as envio',
                'contactos.observaciones',
                'contactos.created_at',
                'contactos.id',
                'contactos.updated_at',
                'users.usuario'
            )
            ->whereIn('contactos.id', $this->ids)
            ->orderByDesc('personas.nombres')
            ->orderByDesc('personas.apellidos')
            ->get();
        $count = count($contacto_busqueda);
        for ($i = 0; $i < $count; $i++) {
            $id_persona =  $contacto_busqueda[$i]->persona_id;
            $id_contacto =  $contacto_busqueda[$i]->id;
            $categorias = DB::table('detalle_categoria_personas')
                ->leftJoin('subcategorias', 'subcategorias.id', '=', 'detalle_categoria_personas.subcategoria_id')
                ->select('subcategorias.nombre')
                ->where('detalle_categoria_personas.persona_id', '=', $id_persona)
                ->get();
            $apellido = DB::table('personas')
                ->select('personas.apellidos')
                ->where('personas.id', '=', $id_persona)
                ->get();
            $categoria = $categorias->pluck('nombre');
            $sal_cat = $categoria->toArray();
            $sal_categorias = implode(", ", $sal_cat);
            $apellidos = $apellido->pluck('apellidos');
            $nombres = $contacto_busqueda[$i]->nombres;
            $contacto = $nombres . " " . $apellidos[0];
            $creador_busqueda = DB::table('contactos')
                ->leftJoin('users', 'users.id', '=', 'contactos.usuario_creacion')
                ->select('users.usuario')
                ->where('contactos.id', '=', $id_persona)
                ->get();
            $creador = $creador_busqueda->pluck('usuario');
            $crea_sal = $creador->toArray();
            $creador_salida = implode(", ", $crea_sal);
            $created_at = new DateTime($contacto_busqueda[$i]->created_at);
            $updated_at = new DateTime($contacto_busqueda[$i]->updated_at);
            $contacto_busqueda[$i]->created_at = $created_at->format('d/m/Y');
            $contacto_busqueda[$i]->updated_at = $updated_at->format('d/m/Y');
            $oficinas = DB::table('oficinas')
                ->leftJoin('contactos', 'contactos.oficina_id', '=', 'oficinas.id')
                ->leftJoin('tipo_oficinas', 'tipo_oficinas.id', '=', 'oficinas.tipo_oficina_id')
                ->join('ciudads', 'ciudads.id', '=', 'oficinas.ciudad_id')
                ->join('departamento_estados', 'departamento_estados.id', 'oficinas.departamento_estado_id')
                ->select(
                    'tipo_oficinas.nombre',
                    'oficinas.direccion',
                    'ciudads.nombre as ciudad',
                    'departamento_estados.nombre as estado'
                )
                ->where('contactos.id', '=', $id_contacto)
                ->orderBy('tipo_oficinas.nombre')
                ->get();
            if ($oficinas->isNotEmpty() && $i < $count) {
                $oficina_nom = $oficinas->pluck('nombre');
                $oficina_dir = $oficinas->pluck('direccion');
                $oficina_ciudad = $oficinas->pluck('ciudad');
                $oficina_estado = $oficinas->pluck('estado');
                $sal_oficinas = $oficina_nom . ":" . $oficina_dir .
                    " (" . $oficina_ciudad . "," . $oficina_estado . ")";
                $contacto_busqueda[$i]->dir = $sal_oficinas;
            } else {
                $contacto_busqueda[$i]->dir = "";
            }
            if ($contacto_busqueda[$i]->representante == true) {
                $contacto_busqueda[$i]->representante = "S";
            } else {
                $contacto_busqueda[$i]->representante = "N";
            }
            if ($contacto_busqueda[$i]->control === true) {
                $contacto_busqueda[$i]->control = "S";
            } else if ($contacto_busqueda[$i]->control === false) {
                $contacto_busqueda[$i]->control = "N";
            }
            if ($contacto_busqueda[$i]->envio === true) {
                $contacto_busqueda[$i]->envio = "S";
            } else if ($contacto_busqueda[$i]->envio === false) {
                $contacto_busqueda[$i]->envio = "N";
            }
            $contacto_busqueda[$i]->persona_id = $sal_categorias;
            $contacto_busqueda[$i]->nombres = $contacto;
            $contacto_busqueda[$i]->id = $creador_salida;
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
            'Email Secundario',
            'Tipo ID',
            'Número ID',
            'Dir. Oficina',
            'Subcategorias',
            'Ciudad',
            'Departamento',
            'Genero',
            'Autoriza tratamiento de datos',
            'Autoriza envío de información',
            'Observaciones',
            'Fecha Creación',
            'Usuario Creación',
            'Última Actualización',
            'Usuario Última Actualización'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'V' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'X' => NumberFormat::FORMAT_DATE_DDMMYYYY
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
