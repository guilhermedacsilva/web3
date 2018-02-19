<?php
namespace Framework;

class DW3Aplicacao
{
    protected $roteador;

    public function __construct()
    {
        $this->iniciarRoteador();
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

    protected function iniciarRoteador()
    {
        $this->roteador = new Roteador();
    }

    protected function executarControlador($parametros)
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
