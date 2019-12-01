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
 * Description of Drink
 *
 * @author Romário Beckman
 */
class Drink {

    function adicionar() {
        $params = Factory::route()->getParams();
        $json = Factory::http()->json();

        if (!isset($json['drink_ml']))
            return ['Error' => 'Item drink_ml não informado'];

        $UserModel = UserDao::getInstance()->fetch([
            'id' => $params[1]
        ]);

        if (empty($UserModel))
            return ['Error' => 'Usuário não existe'];
        else {
            UserDao::getInstance()->updateDrink($UserModel, (int) $json['drink_ml']);
            return [
                'iduser' => $UserModel->getId(),
                'name' => $UserModel->getName(),
                'email' => $UserModel->getName(),
                'drink_counter' => $UserModel->getDrink(),
            ];
        }
    }

}
