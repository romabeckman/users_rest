<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Services\Header;

use Core\Interfaces\AnswerHttp;
use Core\Providers\Factory;

/**
 * Description of Answer200
 *
 * @author Romário Beckman
 */
class Answer200 implements AnswerHttp {

    //put your code here
    public function answer() {
        header(Factory::http()->getProtocol() . " 200 OK");
    }

}
