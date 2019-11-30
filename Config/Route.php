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
        'controller' => 'Usuario/index'
    ],
    'users_busca' => [
        'url' => '/users/([0-9]+)',
        'method' => 'GET',
        'controller' => 'Usuario/listar'
    ],
    'users_delete' => [
        'url' => '/users/([0-9]+)',
        'method' => 'DELETE',
        'controller' => 'Usuario/deletar'
    ],
    'users_drink' => [
        'url' => '/users/([0-9]+)/drink',
        'method' => 'POST',
        'controller' => 'Drink/adicionar'
    ],
    'login' => [
        'url' => '/login/',
        'method' => 'POST',
        'controller' => 'Login/autenticar'
    ]
];
