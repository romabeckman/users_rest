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

use Core\Providers\Factory;
use Core\Providers\Singleton;

class Route extends Singleton {

    private $controller;
    private $method;
    private $config;
    private $proxy;
    private $params;

    public function load() {
        require BASEPATH . 'Config' . DIRECTORY_SEPARATOR . 'Route.php';
        $this->config = $config ?? [];
        $this->setParams();
    }

    private function setParams(): void {
        $http = Factory::http();
        $uri = $http->getUri();
        $method = $http->getMethod();

        foreach ($this->config as $route) {
            $url = explode('/', $route['url']);
            $url = array_filter($url);
            $url = implode('\/', $url);

            if (preg_match('/^\/?' . $url . '\/?$/iu', implode('/', $uri), $match)) {
                if (($route['method'] ?? 'GET') == $method) {
                    $this->params = explode('/', $match[0]);
                    list($this->controller, $this->method) = explode('/', $route['controller']);
                    $this->proxy = $route['proxy'] ?? null;
                    return;
                }
            }
        }

        Factory::header()->setCode(400);
    }

    function getController() {
        return $this->controller;
    }

    function getMethod() {
        return $this->method;
    }

    function getProxy(): ?string {
        return $this->proxy;
    }

    function getParams() {
        return $this->params;
    }

}
