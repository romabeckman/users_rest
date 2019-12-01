<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Dao\UserDao;
use Core\Providers\Factory;

/**
 * Description of Login
 *
 * @author Romário Beckman
 */
class Login {

    function autenticar() {
        $json = Factory::http()->json();

        if (empty($json['email']))
            return ['Error' => 'Campo email é obrigatório'];
        if (!filter_var($json['email'], FILTER_VALIDATE_EMAIL))
            return ['Error' => 'Informe um e-mail válido'];
        if (empty($json['password']))
            return ['Error' => 'Campo senha é obrigatório'];

        $UserModel = UserDao::getInstance()->buscaPorEmailSenha(
                $json['email'],
                $json['password']
        );

        if (empty($UserModel)) {
            Factory::header()->setCode(401);
            return ['Error' => 'Login ou senha não são válidos'];
        }

        $UserModel->generateToken();

        UserDao::getInstance()->update($UserModel);

        return [
            'token' => $UserModel->getToken(),
            'iduser' => $UserModel->getId(),
            'name' => $UserModel->getName(),
            'email' => $UserModel->getName(),
            'drink_counter' => $UserModel->getDrink(),
        ];
    }

}
