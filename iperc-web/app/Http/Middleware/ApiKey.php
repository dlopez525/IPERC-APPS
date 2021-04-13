<?php

namespace App\Http\Middleware;

use Closure;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->has('key')) {
            return response()->json(['status' => 401, 'message' => 'Acceso no Autorizado']);
        }

        if ($request->has('key')) {
            $key = env('API_KEY');

            if ($request->key != $key) {
                return response()->json(['status' => 401, 'message' => 'Acceso no Autorizado']);
            }
        }

        return $next($request);
    }
}
