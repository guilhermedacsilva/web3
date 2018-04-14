<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

abstract class Controlador extends DW3Controlador
{
    protected function verificarLogado()
    {
        if (DW3Sessao::get('usuario') === null) {
            header('Location: ' . URL_RAIZ . 'login');
            exit;
        }
    }
}
