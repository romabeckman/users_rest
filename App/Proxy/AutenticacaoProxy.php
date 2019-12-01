<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Autenticacao
 *
 * @author Romário Beckman
 */

namespace App\Proxy;

use Core\Interfaces\Proxy;
use Core\Providers\Factory;
use App\Dao\UserDao;

class AutenticacaoProxy implements Proxy {

    public function run() {
        $token = Factory::header()->token;

        if (empty($token)) {
            Factory::header()->setCode(401);
            return ['Error' => 'Token de acesso não informado'];
        }

        $userDao = UserDao::getInstance();
        $UserModel = $userDao->fetch(['token' => $token]);

        if (empty($UserModel)) {
            Factory::header()->setCode(401);
            return ['Error' => 'Token de acesso inválido'];
        }

        return null;
    }

}
