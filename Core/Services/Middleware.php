<?php

namespace Core\Services;

defined('BASEPATH') or exit('No direct script access allowed');

use Closure;

abstract class Middleware
{
    abstract public function handle($request, Closure $next);
}
