<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#create',
        'POST' => '\Controlador\LoginControlador#store',
        'DELETE' => '\Controlador\LoginControlador#destroy',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#store',
    ],
    '/usuarios/create' => [
        'GET' => '\Controlador\UsuarioControlador#create',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/mensagens' => [
        'GET' => '\Controlador\MensagemControlador#index',
        'POST' => '\Controlador\MensagemControlador#store',
    ],
];
