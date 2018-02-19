<?php
namespace Lib;

class DW3Aplicacao
{
    private $roteador;

    public function __construct()
    {
        $this->roteador = new DW3Roteador();
    }

    public function rodar()
    {
        $rotaArray = $this->roteador->interpretarRota();
        if ($rotaArray === false) {
            echo 'Rota não encontrada.';
            exit;
        }
        $this->executarControlador($rotaArray);
    }

    private function executarControlador($parametros)
    {
        $controladorString = array_pop($parametros);
        $controladorArray = explode('#', $controladorString);
        $controladorNome = $controladorArray[0];
        $metodoNome = $controladorArray[1];
        $objetoControlador = new $controladorNome();
        $metodoArray = [$objetoControlador, $metodoNome];
        call_user_func_array($metodoArray, $parametros);
    }
}
