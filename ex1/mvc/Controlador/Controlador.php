<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

abstract class Controlador extends DW3Controlador
{
    protected function verificarLogado()
    {
        if (DW3Sessao::get('usuario') === null) {
            $this->redirecionar(URL_RAIZ . 'login');
        }
    }
}
