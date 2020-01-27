<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

use Closure;
use Core\Providers\Singleton;
use Core\Providers\Factory;
use Core\Services\Middleware;
use Core\Services\Route;
use stdClass;

/**
 * Description of Bootstrap
 *
 * @author Romário Beckman
 */
class Bootstrap extends Singleton
{

    public function load()
    {
        $answer = [];
        $route = Factory::route();
        $route->load();

        switch ($route->getStatus()) {
            case Route::FOUND:
                $middleware = $this->runMiddleware($route->getMiddleware());
                break;
            case Route::NOT_FOUND:
                break;
            default:
                # code...
                break;
        }

        if (isset($middleware->Error))
            $answer['Error'] = [$middleware->Error];
        else
            $answer = $this->callController();

        Factory::header()->answer();

        echo is_array($answer) ?
            json_encode($answer) :
            $answer;
    }

    private function callController()
    {
        $route = Factory::route();

        if (empty($route->getController())) {
            Factory::header()->setCode(404);
            return null;
        }

        $controller = '\App\Controllers\\' . $route->getController();
        $object = new $controller();
        return $object->{$route->getMethod()}();
    }

    private function runMiddleware(array $middlewares)
    {
        $object = new stdClass;

        if (empty($middlewares)) {
            return $object;
        } else {
            $return = array_reduce($middlewares, function (Closure $next, Middleware $middleware) {
                return function ($object) use ($next, $middleware) {
                    return $middleware->handle($object, $next);
                };
            }, function ($object) {
                return $object;
            });

            return $return($object);
        }
    }
}
