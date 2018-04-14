<?php
namespace Controlador;

class RaizControlador extends Controlador
{
    public function index()
    {
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
