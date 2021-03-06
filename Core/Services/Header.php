<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Services;

use Core\Providers\Singleton;

/**
 * Description of Header
 *
 * @author Romário Beckman
 */
class Header extends Singleton {

    private $code = 200;
    private $ContentType = 'application/json';

    function setCode($code): void {
        $this->code = $code;
    }

    function setContentType($ContentType): void {
        $this->ContentType = $ContentType;
    }

    function setHeader(string $header, bool $replace = true) {
        header($header, $replace);
    }

    public function answer() {
        $class = 'Core\Services\Header\Answer' . $this->code;
        $object = new $class();
        $object->answer();
    }

    function getCode(): int {
        return $this->code;
    }

    function getContentType(): string {
        return $this->ContentType;
    }

    public function __get($name): ?string {
        $name = strtoupper($name);

        if (isset($_SERVER[$name]))
            return $_SERVER[$name];
        elseif (isset($_SERVER['HTTP_' . $name]))
            return $_SERVER['HTTP_' . $name];

        return null;
    }

}
