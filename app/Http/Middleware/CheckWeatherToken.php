<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckWeatherToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('x-token');
        $validToken = config('services.weather.x_token');

        if ($token !== $validToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
