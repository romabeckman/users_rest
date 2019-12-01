<?php

$config = [
    'users_post' => [
        'url' => '/users/',
        'method' => 'POST',
        'controller' => 'Usuario/cadastrar'
    ],
    'users_get' => [
        'url' => '/users/',
        'method' => 'GET',
        'controller' => 'Usuario/index',
        'proxy' => 'App\Proxy\AutenticacaoProxy'
    ],
    'users_buscas' => [
        'url' => '/users/([0-9]+)',
        'method' => 'GET',
        'controller' => 'Usuario/buscar',
        'proxy' => 'App\Proxy\AutenticacaoProxy'
    ],
    'users_delete' => [
        'url' => '/users/([0-9]+)',
        'method' => 'DELETE',
        'controller' => 'Usuario/deletar',
        'proxy' => 'App\Proxy\AutenticacaoProxy'
    ],
    'users_edit' => [
        'url' => '/users/([0-9]+)',
        'method' => 'PUT',
        'controller' => 'Usuario/editar',
        'proxy' => 'App\Proxy\AutenticacaoProxy'
    ],
    'users_drink' => [
        'url' => '/users/([0-9]+)/drink',
        'method' => 'POST',
        'controller' => 'Drink/adicionar',
        'proxy' => 'App\Proxy\AutenticacaoProxy'
    ],
    'login' => [
        'url' => '/login/',
        'method' => 'POST',
        'controller' => 'Login/autenticar'
    ]
];
