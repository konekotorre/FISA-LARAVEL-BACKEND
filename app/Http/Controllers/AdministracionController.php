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
use Illuminate\Http\Request;

class AdministracionController extends Controller
{
    public function indexOrgVarios()
    {
        return response()->json([
            "success" => true,
            "tipo_documentos" => TipoDocumentoOrganizacion::orderBy('nombre')->get(),
            "categorias" => Categoria::all(),
            "tipo_organizaciones" => TipoOrganizacion::all(),
            "clases" => Clase::orderBy('nombre')->get()
        ], 200);
    }

    public function indexOrgActividad()
    {
        return response()->json([
            "success" => true,
            "sectores" => Sector::all(),
            "ciius" => Ciiu::all()
        ], 200);
    }

    public function indexInfoFinanciera()
    {
        return response()->json([
            "success" => true,
            "clasificaciones" => Clasificacion::all(),
            "regimenes" => Regimen::all()
        ], 200);
    }

    public function indexOfiCont()
    {
        return response()->json([
            "success" => true,
            "tipo_documentos" => TipoDocumentoPersona::all(),
            "sexos" => Sexo::all(),
            "subcategorias" => Subcategoria::all(),
            "tipo_oficinas" => TipoOficina::all()
        ], 200);
    }

    public function indexSeguimiento()
    {
        return response()->json([
            "success" => true,
            "tareas" => EstadoTarea::all(),
            "visitas" => EstadoVisita::all()
        ], 200);
    }
}
