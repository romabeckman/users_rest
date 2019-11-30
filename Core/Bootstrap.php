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
        $route = Factory::route();

        $header = Factory::header();
        $answer = $this->callController();

        $route->load();
        $header->answer();

        if (is_array($answer))
            echo json_encode($answer);
        else
            echo $answer;
    }

    private function callController() {
        $route = Factory::route();

        if (empty($route->getController())) {
            Factory::header()->setCode(404);
            return null;
        }

        echo $controller = '\App\Controllers\\' . $route->getController();
        $object = new $controller();
        return $object->{$route->getMethod()}();
    }

}
