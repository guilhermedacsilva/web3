<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/reclamacoes' => [
        'GET' => '\Controlador\ReclamacaoControlador#index',
        'POST' => '\Controlador\ReclamacaoControlador#armazenar',
    ],
    '/reclamacoes/?' => [
        'PATCH' => '\Controlador\ReclamacaoControlador#atualizar',
    ],
    '/reclamacoes/criar' => [
        'GET' => '\Controlador\ReclamacaoControlador#criar',
    ],
];
