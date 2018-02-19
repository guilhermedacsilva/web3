<?php

$rotas = [
    '/' => [
        'GET' => '\Controller\RaizController#index',
    ],
    '/login' => [
        'GET' => '\Controller\LoginController#create',
        'POST' => '\Controller\LoginController#store',
        'DELETE' => '\Controller\LoginController#destroy',
    ],
    '/usuarios' => [
        'POST' => '\Controller\UsuarioController#store',
    ],
    '/usuarios/create' => [
        'GET' => '\Controller\UsuarioController#create',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controller\UsuarioController#sucesso',
    ],
    '/mensagens' => [
        'GET' => '\Controller\MensagemController#index',
        'POST' => '\Controller\MensagemController#store',
    ],
];
