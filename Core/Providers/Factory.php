<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Factory
 *
 * @author Romário Beckman
 */

namespace Core\Providers;

use Core\Drivers\JsonDriver;
use Core\Services\Http;
use Core\Services\Route;
use Core\Services\Header;

class Factory {

    static function jsonDriver(): JsonDriver {
        $config['directory'] = BASEPATH . 'Databases' . DIRECTORY_SEPARATOR . 'Json' . DIRECTORY_SEPARATOR;
        $JsonDriver = new JsonDriver();
        return $JsonDriver->connection($config);
    }

    static function http(): Http {
        return Http::getInstance();
    }

    static function route(): Route {
        return Route::getInstance();
    }

    static function header(): Header {
        return Header::getInstance();
    }

}
