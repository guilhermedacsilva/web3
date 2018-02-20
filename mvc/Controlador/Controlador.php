<?php
namespace Controlador;

use \Lib\DW3Controlador;

class Controlador extends DW3Controlador
{
    protected function verificarLogado()
    {
        if (DW3Sessao::get('usuario') === null) {
            header('Location: ' . URL_RAIZ . 'login');
            exit;
        }
    }
}