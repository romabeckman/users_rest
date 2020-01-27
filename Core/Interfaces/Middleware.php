<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Interfaces;

use Closure;

/**
 *
 * @author Romário Beckman
 */
interface Middleware {

    public function handle($request, Closure $next);
}
