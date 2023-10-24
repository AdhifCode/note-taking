<?php

namespace App\Http\Middleware;

use Closure;

class CatatanMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->header('Authorization') !== 'TokenYangDiharapkan') {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
