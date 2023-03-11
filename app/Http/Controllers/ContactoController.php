<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\DetalleCategoriaPersona;
use App\Exports\ConBusquedaExport;
use App\Persona;
use App\Sexo;
use App\TipoDocumentoPersona;
use App\Subcategoria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ContactoController extends Controller
{

    public function index(Request $request)
    {
        $skip = $request->query('skip') ? $request->query('skip') : null;
        $limit = $request->query('limit') ? $request->query('limit') : null;

        $count = Contacto::where('id', '>', 0)->count();

        $contactos = DB::table('contactos')
            ->leftJoin('organizacions', 'organizacions.id', '=', 'contactos.organizacion_id')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->select(
                'contactos.id as contacto_id',
                'personas.id as persona_id',
                'contactos.email',
                'personas.celular',
                'contactos.telefono',
                'contactos.extension',
                'contactos.cargo',
                'contactos.observaciones',
                'organizacions.nombre as organizacion',
                DB::raw("CONCAT(personas.nombres, ' ', personas.apellidos) as nombres")
            )
            ->orderBy('personas.nombres')
            ->orderBy('personas.apellidos')
            ->orderByDesc('contactos.estado')
            ->when($skip, function ($query, $skip) {
                return $query->skip($skip);
            })
            ->when($limit, function ($query, $limit) {
                return $query->take($limit);
            })
            ->get();

            return response()->json([
            'success' => true,
            'message' => "Se consultaron correctamente los contactos",
            'contactos' => $contactos,
            'skip' => $skip,
            'limit' => $limit,
            'total' => $count
        ], 200);
    }

    public function indexByOrganizacion(Request $request)
    {
        $contactos = DB::table('contactos')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->select(
                'contactos.id as contacto_id',
                'personas.id as persona_id',
                'personas.nombres',
                'personas.apellidos',
                'contactos.email',
                'personas.celular',
                'contactos.telefono',
                'contactos.extension',
                'contactos.cargo',
                'contactos.observaciones'
            )
            ->where('contactos.organizacion_id', '=', $request->organizacion_id)
            ->orderBy('personas.nombres')
            ->orderBy('personas.apellidos')
            ->orderByDesc('contactos.estado')
            ->get();
        return response()->json([
            "success" => true,
            "contactos" => $contactos,
        ], 200);
    }

    public function repFecha(Request $request)
    {
        return Excel::download(new ConBusquedaExport($request), 'Reporte de Contactos.xlsx');
    }

    public function repBusqueda(Request $request)
    {
        return Excel::download(new ConBusquedaExport($request), 'Reporte de Contactos.xlsx');
    }

    public function repGen(Request $request)
    {
        return Excel::download(new ConBusquedaExport($request), 'Reporte de Contactos.xlsx');
    }

    public function listForms()
    {
        return response()->json([
            "success" => true,
            "tipos" => TipoDocumentoPersona::orderBy('nombre')->get(),
            "subcategorias" => Subcategoria::orderBy('nombre')->get(),
            "sexos" => Sexo::orderBy('nombre')->get()
        ], 200);
    }


    public function search(Request $request)
    {
        $contactos_salida = [];
        $names = $request->nombres ? explode(" ", trim($request->nombres)) : null;
        $p_name = isset($names[0]) ?  $names[0] : null;
        $s_name = isset($names[1]) ?  $names[1]: null;
        $t_name = isset($names[2]) ?  $names[2] : null;
        $c_name = isset($names[3]) ?  $names[3] : null;

        $orderType = $request->orderType ? $request->orderType : null;
        $orderKey = $request->orderKey ? $request->orderKey : null;

        switch ($orderKey) {
            case 'organizacion':
                $orderKey = 'organizacions.nombre';
                break;
            case 'nombre':
                $orderKey = 'personas.nombres';
                break;
            case 'cargo':
                $orderKey = 'contactos.cargo';
                break;
            default:
                break;
        }

        $organizacion = trim($request->organizacion);
        $cargo = trim($request->cargo);
        $email = trim($request->email);
        $pais = $request->pais;
        $departamento = $request->departamento;
        $ciudad = $request->ciudad;
        $categorias = $request->categorias;
        $subcategorias = $request->subcategorias;
        $sector = $request->sector;
        $subsector = $request->subsector;

        $skip = $request->skip ? intval($request->skip,10) : 0;
        $limit = $request->limit ? intval($request->limit, 10) : 0;

        $contactos = DB::table('contactos')
            ->join('personas', 'personas.id', 'contactos.persona_id')
            ->leftJoin('oficinas', 'oficinas.id', 'contactos.oficina_id')
            ->leftJoin('ciudads', 'ciudads.id', 'oficinas.ciudad_id')
            ->leftJoin('departamento_estados', 'departamento_estados.id', 'oficinas.departamento_estado_id')
            ->leftJoin('pais', 'pais.id', 'oficinas.pais_id')
            ->leftJoin('organizacions', 'organizacions.id', 'contactos.organizacion_id')
            ->leftJoin('detalle_categoria_personas', 'detalle_categoria_personas.persona_id', 'personas.id')
            ->select(
                'contactos.id as contacto_id',
                'personas.id as persona_id',
                'contactos.email',
                'personas.celular',
                'contactos.telefono',
                'contactos.extension',
                'contactos.cargo',
                'contactos.observaciones',
                'organizacions.nombre as organizacion',
                DB::raw("CONCAT(personas.nombres, ' ', personas.apellidos) as nombres")
            )
            ->when($subcategorias, function ($query, $subcategorias) {
                return $query->whereIn('detalle_categoria_personas.subcategoria_id', $subcategorias);
            })
            ->when($categorias, function ($query, $categorias) {
                return $query->whereIn('organizacions.categoria_id', $categorias);
            })
            ->when($organizacion, function ($query, $organizacion) {
                return $query->where('organizacions.nombre', 'ilike', '%'.$organizacion.'%');
            })
            ->when($email, function ($query, $email) {
                return $query->where('contactos.email', 'ilike', '%'.$email.'%');
            })
            ->when($cargo, function ($query, $cargo) {
                return $query->where('contactos.cargo', 'ilike', '%'.$cargo.'%');
            })
            ->when($sector, function ($query, $sector) {
                return $query->where('organizacions.sector_id', $sector);
            })
            ->when($subsector, function ($query, $subsector) {
                return $query->where('organizacions.subsector_id', $subsector);
            })
            ->when($pais, function ($query, $pais) {
                return $query->where('oficinas.pais_id', $pais);
            })
            ->when($departamento, function ($query, $departamento) {
                return $query->where('oficinas.departamento_estado_id', $departamento);
            })
            ->when($ciudad, function ($query, $ciudad) {
                return  $query->where('oficinas.ciudad_id', $ciudad);
            })
            ->orderBy($orderKey, $orderType)
            ->distinct()
            ->get();


        if ($names) {
            for ($i = 0; $i < count($contactos); $i++) {
                $name = $contactos[$i]->nombres;
                if ($p_name && $s_name === null && $t_name === null && $c_name === null) {
                    if (strpos(strtolower($name), strtolower($p_name)) !== false) {
                        array_push($contactos_salida, $contactos[$i]);
                    }
                } else if ($p_name && $s_name && $t_name === null && $c_name === null) {
                    if (
                        strpos(strtolower($name), strtolower($p_name)) !== false &&
                        strpos(strtolower($name), strtolower($s_name)) !== false
                    ) {
                        array_push($contactos_salida, $contactos[$i]);
                    }
                } else if ($p_name && $s_name && $t_name && $c_name === null) {
                    if (
                        strpos(strtolower($name), strtolower($p_name)) !== false &&
                        strpos(strtolower($name), strtolower($s_name)) !== false &&
                        strpos(strtolower($name), strtolower($t_name)) !== false
                    ) {
                        array_push($contactos_salida, $contactos[$i]);
                    }
                } else if ($p_name && $s_name && $t_name && $c_name) {
                    if (
                        strpos(strtolower($name), strtolower($p_name)) !== false &&
                        strpos(strtolower($name), strtolower($s_name)) !== false &&
                        strpos(strtolower($name), strtolower($t_name)) !== false &&
                        strpos(strtolower($name), strtolower($c_name)) !== false
                    ) {
                        array_push($contactos_salida, $contactos[$i]);
                    }
                }
            }
        } else {
            $contactos_salida = $contactos;
        }

        if($skip >= 0 && $limit > 0){
            if(is_array($contactos_salida)){
                $contactos_salida = array_slice($contactos_salida, $skip, $limit);
            }
            else{
                $contactos_salida = $contactos_salida->skip($skip)->take($limit)->get();
            }
        } 
       

        return response()->json([
            'type' => gettype($contactos_salida),
            'success' => true,
            'message' => "Se consultaron correctamente los contactos",
            'total' => count($contactos),
            'skip' => $skip,
            'limit' => $limit,
            "contactos" => $contactos_salida ? $contactos_salida : []
        ], 200);
    }


    public function store(Request $request)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_creacion'] = $creador_auth['id'];
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        if ($solicitud['persona_id'] == null) {
            $persona = Persona::create($solicitud);
            $solicitud['persona_id'] = $persona->id;
        } else {
            DB::update(
                'update personas set(tipo_documento_persona_id, numero_documento, nombres, 
                    apellidos, celular, sexo_id, usuario_actualizacion, updated_at) 
                        = (?, ?, ?, ?, ?, ?, ?, ?) where id = ?',
                [
                    $solicitud['tipo_documento_persona_id'],
                    $solicitud['numero_documento'],
                    $solicitud['nombres'],
                    $solicitud['apellidos'],
                    $solicitud['celular'],
                    $solicitud['sexo_id'],
                    $creador_auth['id'],
                    Carbon::now(),
                    $solicitud['persona_id']
                ]
            );
        }
        DB::table('detalle_categoria_personas')
            ->where('persona_id', '=', $solicitud['persona_id'])
            ->delete();
        $key = $request->categorias;
        if (!empty($key)) {
            $count = count($key);
            for ($i = 0; $i < $count; $i++) {
                $categoria['persona_id'] = $solicitud['persona_id'];
                $categoria['subcategoria_id'] = $key[$i];
                DetalleCategoriaPersona::create($categoria);
            }
        }
        Contacto::create($solicitud);
        return response()->json([
            "success" => true,
        ], 200);
    }


    public function show(Contacto $contacto)
    {
        $contacto_busqueda = DB::table('contactos')
            ->join('personas', 'personas.id', '=', 'contactos.persona_id')
            ->select(
                'contactos.*',
                'personas.id as persona_id',
                'personas.nombres',
                'personas.apellidos',
                'personas.tipo_documento_persona_id',
                'personas.numero_documento',
                'personas.sexo_id',
                'personas.celular',
                'personas.updated_at as date_update_user'
            )
            ->where('contactos.id', '=', $contacto->id)
            ->first();
        $categorias = DB::table('detalle_categoria_personas')
            ->select('subcategoria_id')
            ->where('detalle_categoria_personas.persona_id', '=', $contacto_busqueda->persona_id)
            ->orderBy('detalle_categoria_personas.subcategoria_id')
            ->get();
        $creador = DB::table('contactos')
            ->join('users', 'users.id', '=', 'contactos.usuario_creacion')
            ->select('users.usuario')
            ->where('contactos.id', '=', $contacto->id)
            ->first();
        $editor_contacto = DB::table('contactos')
            ->join('users', 'users.id', '=', 'contactos.usuario_actualizacion')
            ->select('users.usuario')
            ->where('contactos.id', '=', $contacto_busqueda->id)
            ->first();
        $editor_persona = DB::table('personas')
            ->join('users', 'users.id', '=', 'personas.usuario_actualizacion')
            ->select('users.usuario')
            ->where('personas.id', '=', $contacto_busqueda->persona_id)
            ->first();
        if($contacto_busqueda->updated_at >= $contacto_busqueda->date_update_user){
            $contacto_busqueda->updated_at = $contacto_busqueda->updated_at;
            $editor = $editor_contacto;
        }
        else {
            $contacto_busqueda->updated_at = $contacto_busqueda->date_update_user;
            $editor = $editor_persona;
        }
        return response()->json([
            "success" => true,
            "contacto" => $contacto_busqueda,
            "categorias" => $categorias->pluck('subcategoria_id'),
            "usuario_creacion" => $creador,
            "usuario_actualizacion" => $editor
        ], 200);
    }


    public function update(Request $request, Contacto $contacto)
    {
        $solicitud = $request->all();
        $creador_auth = Auth::user();
        $solicitud['usuario_actualizacion'] = $creador_auth['id'];
        if ($solicitud['persona_id'] == null) {
            $persona = Persona::create($solicitud);
            $solicitud['persona_id'] = $persona->id;
        } else {
            $persona = Persona::find($solicitud['persona_id']);
            $persona->update($solicitud);    
        }
        DB::table('detalle_categoria_personas')
            ->where('persona_id', '=', $solicitud['persona_id'])
            ->delete();
        $key = $request->categorias;
        if (!empty($key)) {
            for ($i = 0; $i < count($key); $i++) {
                $categoria['persona_id'] = $solicitud['persona_id'];
                $categoria['subcategoria_id'] = $key[$i];
                DetalleCategoriaPersona::create($categoria);
            }
        }

        $contacto->update($solicitud);
        
        DB::update(
            'update contactos set(usuario_actualizacion, updated_at) = (?, ?) where id = ?',
            [$creador_auth['id'], Carbon::now(), $contacto->id]
        );

        return response()->json([
            "success" => true
        ], 200);
    }

    public function destroy(Contacto $contacto)
    {
        $persona_id = DB::table('contactos')
            ->select('persona_id')
            ->where('id', '=', $contacto->id)
            ->get();
        $id_temp = $persona_id->pluck('persona_id');
        $contactos = DB::table('contactos')
            ->select('id')
            ->where('persona_id', '=', $id_temp[0])
            ->get();
        if ($contactos->count() == 1) {
            $contacto->delete();
            DB::table('personas')
                ->where('id', '=', $id_temp[0])
                ->delete();
        } else {
            $contacto->delete();
        }
        return response()->json(["success" => true], 200);
    }
}
