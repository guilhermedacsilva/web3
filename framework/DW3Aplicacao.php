<?php
namespace Framework;

class DW3Aplicacao
{
    private $roteador;

    public function __construct()
    {
        DW3Sessao::iniciar();
        $this->roteador = new DW3Roteador();
    }

    public function executar()
    {
        $encontrou = $this->interpretarRota();
        if ($encontrou) {
            $this->executarControlador();
        }
    }

    private function interpretarRota()
    {
        $this->roteador->interpretarRota();
        if (!$this->roteador->getResultado()) {
            echo 'Rota não encontrada.';
            return false;
        }
        return true;
    }

    private function executarControlador()
    {
        $rota = $this->roteador->getResultado();
        $controladorNome = $rota->getControlador();

        // um objeto pode ser instanciado com uma classe ou uma string
        $objetoControlador = new $controladorNome;

        $metodoArray = [$objetoControlador, $rota->getMetodo()];

        // executa um método passando parâmetros
        try {
            call_user_func_array($metodoArray, $rota->getParametros());
        } catch (DW3RedirecionarException $e) {}
    }
}
