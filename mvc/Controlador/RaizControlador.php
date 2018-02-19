<?php
namespace Controlador;

class RaizControlador extends Controlador
{
    public function index()
    {
        header('Location: ' . URL_RAIZ . 'login');
        exit;
    }
}
