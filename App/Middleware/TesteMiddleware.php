<?php

namespace App\Middleware;

use Closure;
use Core\Interfaces\Middleware as InterfacesMiddleware;

class TesteMiddleware implements InterfacesMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
