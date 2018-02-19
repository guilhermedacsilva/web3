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
        if (!$this->roteador->getResultado()) {
            echo 'Rota não encontrada.';
            exit;
        }
    }

    private function executarControlador()
    {
        $rota = $this->roteador->getResultado();
        $controladorNome = $rota->getControlador();
        
        // um objeto pode ser instanciado com uma classe ou uma string
        $objetoControlador = new $controladorNome;
        
        $metodoArray = [$objetoControlador, $rota->getMetodo()];
        
        // executa um método passando parâmetros
        call_user_func_array($metodoArray, $rota->getParametros());
    }
}
