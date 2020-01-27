<?php

namespace App\Middleware;

use Closure;
use Core\Services\Middleware;

class TesteMiddleware extends Middleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
