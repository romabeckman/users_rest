<?php

return [
    ['url' => '/users/', 'method' => 'POST', 'controller' => 'Usuario/cadastrar'],
    ['url' => '/login/', 'method' => 'POST', 'controller' => 'Login/autenticar'],
    "\App\Middleware\AuthMiddleware" => function () {
        return [
            "\App\Middleware\TesteMiddleware" => function () {
                return [
                    ['url' => '/users/', 'method' => 'GET', 'controller' => 'Usuario/index'],
                    ['url' => '/users/([0-9]+)', 'method' => 'GET', 'controller' => 'Usuario/buscar']
                ];
            },
            ['url' => '/users/([0-9]+)', 'method' => 'DELETE', 'controller' => 'Usuario/deletar'],
            ['url' => '/users/([0-9]+)', 'method' => 'PUT', 'controller' => 'Usuario/editar'],
            ['url' => '/users/([0-9]+)/drink', 'method' => 'POST', 'controller' => 'Drink/adicionar']
        ];
    }
];
