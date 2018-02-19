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
        $this->interpretarRota();
        $this->executarControlador();
    }

    private function interpretarRota()
    {
        $this->roteador->interpretarRota();
        if ($this->roteador->getResultado() === false) {
            echo 'Rota não encontrada.';
            exit;
        }
    }

    /* Formato do resultado do roteador
    [
        0,1,2... => parâmetros para serem passados da rota para o controlador...
        último => 'NomeDoControlador#métodoParaExecutar',
    ]
    */
    private function executarControlador()
    {
        $rotaResultado = $this->roteador->getResultado();
        $controladorString = array_pop($rotaResultado);
        $controladorArray = explode('#', $controladorString);
        $this->rodarControladorComParametros(
            $controladorArray[0],
            $controladorArray[1],
            $rotaResultado);
    }

    private function rodarControladorComParametros(
        $controladorNome,
        $metodoNome,
        $parametros)
    {
        $objetoControlador = new $controladorNome();
        $metodoArray = [$objetoControlador, $metodoNome];
        call_user_func_array($metodoArray, $parametros);
    }
}
