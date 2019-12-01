<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Romário Beckman
 */

namespace App\Controllers;

use App\Dao\UserDao;
use Core\Providers\Factory;

class Usuario {

    function index() {

    }

    function cadastrar() {
        $json = Factory::http()->json();

        if (empty($json['name']))
            return ['Error' => 'Campo nome é obrigatório'];
        if (empty($json['email']))
            return ['Error' => 'Campo email é obrigatório'];
        if (!filter_var($json['email'], FILTER_VALIDATE_EMAIL))
            return ['Error' => 'Informe um e-mail válido'];
        if (empty($json['password']))
            return ['Error' => 'Campo senha é obrigatório'];

        $UserModel = UserDao::getInstance()->fetch(['email' => $json['email']]);

        if (!empty($UserModel))
            return ['Error' => 'E-mail ' . $json['email'] . ' já está cadastrado, informe outro e-mail.'];


        $UserModel = UserDao::getInstance()->inserir(
                $json['name'],
                $json['email'],
                $json['password']
        );

        Factory::header()->setCode(201);
        Factory::header()->setHeader('Location: /users/' . $UserModel->getId());
        Factory::header()->setHeader('Content-Location: /users/' . $UserModel->getId());
        return [];
    }

    function listar() {

    }

    function deletar() {

    }

}
