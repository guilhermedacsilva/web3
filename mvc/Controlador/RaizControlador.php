<?php
namespace Controlador;

class RaizControlador
{
    public function index()
    {
        header('Location: ' . URL_RAIZ . 'login');
        exit;
    }
}
