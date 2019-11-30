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

namespace Providers;

use \App\Models\UserModel;
use \App\Daos\UserDao;
use \Drivers\JsonDriver;

class Factory {

    static function userModel(): UserModel {
        return new UserModel();
    }

    static function userDao(): UserDao {
        return UserDao::getInstance();
    }

    static function jsonDriver(): JsonDriver {
        $config['directory'] = BASEPATH . 'Databases' . DIRECTORY_SEPARATOR . 'Json' . DIRECTORY_SEPARATOR;
        $JsonDriver = new JsonDriver();
        return $JsonDriver->connection($config);
    }

}
