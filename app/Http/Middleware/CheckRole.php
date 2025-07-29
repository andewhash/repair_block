<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
   // app/Http/Middleware/CheckRole.php
public function handle(Request $request, Closure $next, $role)
{
    if (!auth()->check() || auth()->user()->role != $role) {
        abort(403, 'Доступ запрещен');
    }

    return $next($request);
}
}
