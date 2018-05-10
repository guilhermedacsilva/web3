<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    // REST
    '/contatos' => [
        'GET' => '\Controlador\ContatoControlador#index',
        'POST' => '\Controlador\ContatoControlador#armazenar',
    ],
    // REST
    '/contatos/?' => [
        'GET' => '\Controlador\ContatoControlador#mostrar',
        'PATCH' => '\Controlador\ContatoControlador#atualizar',
        'DELETE' => '\Controlador\ContatoControlador#destruir',
    ],
    // NÃO INCLUSO NO REST
    '/contatos/criar' => [
        'GET' => '\Controlador\ContatoControlador#criar',
    ],
    // NÃO INCLUSO NO REST
    '/contatos/?/editar' => [
        'GET' => '\Controlador\ContatoControlador#editar',
    ],
];
