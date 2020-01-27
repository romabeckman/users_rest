<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Route
 *
 * @author Romário Beckman
 */

namespace Core\Services;

defined('BASEPATH') or exit('No direct script access allowed');

use Closure;
use Core\Providers\Factory;
use Core\Providers\Singleton;

class Route extends Singleton
{

    const FOUND = 1;
    const NOT_FOUND = 0;

    private $status = self::NOT_FOUND;
    private $controller;
    private $method;
    private $params;
    private $middlewares = [];

    public function load()
    {
        $config = require BASEPATH . 'Config' . DIRECTORY_SEPARATOR . 'Route.php';
        $this->setParams($config);
    }

    private function setParams($routes = [])
    {
        $http = Factory::http();
        $uri = $http->getUri();
        $method = $http->getMethod();

        foreach ($routes as $middleware => $route) {
            if ($this->status == self::FOUND)
                return;

            if ($route instanceof Closure) {
                $this->setParams($route());

                if ($this->status == self::FOUND)
                    $this->middlewares[] = new $middleware();
            } else {
                $urlRegx = implode("\/", $http->getUri($route['url']));
                if (preg_match('/^\/?' . $urlRegx . '\/?$/iu', implode('/', $uri), $match)) {
                    if (($route['method'] ?? 'GET') == $method) {
                        $this->params = explode('/', $match[0]);
                        list($this->controller, $this->method) = explode('/', $route['controller']);
                        $this->status = self::FOUND;
                    }
                }
            }
        }
    }

    function getController()
    {
        return $this->controller;
    }

    function getMethod()
    {
        return $this->method;
    }

    function getParams()
    {
        return $this->params;
    }

    function getMiddleware(): array
    {
        return $this->middlewares;
    }

    function getStatus()
    {
        return $this->status;
    }
}
