<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

use Core\Providers\Singleton;
use Core\Providers\Factory;

/**
 * Description of Bootstrap
 *
 * @author Romário Beckman
 */
class Bootstrap extends Singleton {

    public function load() {
        Factory::route()->load();
        $answer = null;

        $answer = $this->runProxy();

        if (Factory::header()->getCode() < 300 and empty($answer)) {
            $answer = $this->callController();
        }

        Factory::header()->answer();

        echo is_array($answer) ?
                json_encode($answer) :
                $answer;
    }

    private function callController() {
        $route = Factory::route();

        if (empty($route->getController())) {
            Factory::header()->setCode(404);
            return null;
        }

        $controller = '\App\Controllers\\' . $route->getController();
        $object = new $controller();
        return $object->{$route->getMethod()}();
    }

    private function runProxy() {
        $route = Factory::route();

        if (empty($route->getProxy()))
            return;

        $proxy = $route->getProxy();
        $object = new $proxy();
        return $object->run();
    }

}
