<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
        $response->headers->set('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With, X-Auth-Token');
        $response->headers->set('Access-Control-Allow-Credentials',' true');
        $response->headers->set('Cross-Origin-Embedder-Policy: require-corp',' true');
        $response->headers->set('Cross-Origin-Opener-Policy: same-origin',' true');
        return $response;

    }
}
