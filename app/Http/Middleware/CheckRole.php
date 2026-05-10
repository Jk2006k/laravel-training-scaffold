<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // TODO Day 9: check if auth()->user()->role === $role, else abort(403)
        // Then register this middleware in bootstrap/app.php (Laravel 11+)
        // or app/Http/Kernel.php (Laravel 10) with the alias 'role'
        // so you can use ->middleware('role:admin')
        if (!auth()->check() || auth()->user()->role !== $role) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}