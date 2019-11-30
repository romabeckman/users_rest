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

            if (preg_match('/\/?' . $url . '\/?/', implode('/', $uri))) {
                if ($route['method'] == $method) {
                    list($this->controller, $this->method) = explode('/', $route['controller']);
                    return;
                }
            }
        }
    }

    function getController() {
        return $this->controller;
    }

    function getMethod() {
        return $this->method;
    }

}
