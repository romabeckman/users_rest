<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Services;

defined('BASEPATH') or exit('No direct script access allowed');

use Core\Providers\Singleton;

/**
 * Description of Routes
 *
 * @author Romário Beckman
 */
class Http extends Singleton {

    public function getProtocol(): string {
        return $_SERVER['SERVER_PROTOCOL'];
    }

    public function getUri(): array {
        return array_filter(
                explode(
                        '/',
                        strstr($_SERVER['REQUEST_URI'], '?', true) ?: $_SERVER['REQUEST_URI']
                )
        );
    }

    public function getMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get(): array {
        return $_GET;
    }

    public function post(): array {
        return $_POST;
    }

    public function put() {
        if ($this->getMethod() != 'PUT')
            return [];

        return $this->getPhpInput();
    }

    public function delete() {
        if ($this->getMethod() != 'DELETE')
            return [];

        return $this->getPhpInput();
    }

    private function getPhpInput() {
        parse_str(file_get_contents("php://input"), $post_vars);
        return $post_vars;
    }

}
