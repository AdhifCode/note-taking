<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Closure;

class CatatanMiddleware
{
    public function handle($request, Closure $next)
    {
        // if ($request->header('Authorization') !== 'Bearer TokenYangDiharapkan') {
        //     return response('Tidak Boleh', 401);
        // }
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        return $next($request);
    }
}
