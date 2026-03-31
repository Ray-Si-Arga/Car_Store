<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login DAN memiliki role admin
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(404, 'Otoritas ditolak');
        }

        return $next($request);
    }
}
