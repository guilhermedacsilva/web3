<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;
use \Modelo\Usuario;

/* Métodos úteis da visão */
trait ControladorVisao
{
    /* Caso o campo tenha um erro, retorna a classe CSS de erro */
    protected function getErroCss($campoNome)
    {
        return $this->temErro($campoNome) ? 'has-error' : '';
    }
}
