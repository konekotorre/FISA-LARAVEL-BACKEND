<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Ciiu;
use App\Clase;
use App\Clasificacion;
use App\EstadoTarea;
use App\EstadoVisita;
use App\Regimen;
use App\Sector;
use App\Sexo;
use App\Subcategoria;
use App\TipoDocumentoOrganizacion;
use App\TipoDocumentoPersona;
use App\TipoOficina;
use App\TipoOrganizacion;

class AdministracionController extends Controller
{
    public function indexOrgVarios()
    {
        return response()->json([
            "success" => true,
            "tipo_documentos" => TipoDocumentoOrganizacion::orderBy('nombre')->get(),
            "categorias" => Categoria::orderBy('nombre')->get(),
            "tipo_organizaciones" => TipoOrganizacion::orderBy('nombre')->get(),
            "clases" => Clase::orderBy('nombre')->get()
        ], 200);
    }

    public function indexOrgActividad()
    {
        return response()->json([
            "success" => true,
            "sectores" => Sector::all(),
            "ciius" => Ciiu::orderBy('nombre')->get()
        ], 200);
    }

    public function indexInfoFinanciera()
    {
        return response()->json([
            "success" => true,
            "clasificaciones" => Clasificacion::orderBy('nombre')->get(),
            "regimenes" => Regimen::orderBy('nombre')->get()
        ], 200);
    }

    public function indexOfiCont()
    {
        return response()->json([
            "success" => true,
            "tipo_documentos" => TipoDocumentoPersona::orderBy('nombre')->get(),
            "sexos" => Sexo::orderBy('nombre')->get(),
            "subcategorias" => Subcategoria::orderBy('nombre')->get(),
            "tipo_oficinas" => TipoOficina::orderBy('nombre')->get()
        ], 200);
    }

    public function indexSeguimiento()
    {
        return response()->json([
            "success" => true,
            "tareas" => EstadoTarea::orderBy('nombre')->get(),
            "visitas" => EstadoVisita::orderBy('nombre')->get()
        ], 200);
    }
}
