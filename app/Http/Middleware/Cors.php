<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With, X-Auth-Token');
        $response->headers->set('Access-Control-Allow-Credentials',' true');
        return $response;

        // return $next($request)
        //     ->header("Access-Control-Allow-Credentials", "true")
        //     //Url a la que se le dará acceso en las peticiones
        //     ->header("Access-Control-Allow-Origin", "*")
        //     //Métodos que a los que se da acceso
        //     ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
        //     //Headers de la petición
        //     ->header("Access-Control-Allow-Headers", "Origin, Content-Type, Accept, Authorization, X-Request-With, X-Auth-Token");
    }
}
