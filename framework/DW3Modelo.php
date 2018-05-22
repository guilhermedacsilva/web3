<?php
namespace Framework;

abstract class DW3Modelo
{
	protected $__erros = [];

    /* Use $this->setErroMensagem() quando encontrar um erro */
    protected function verificarErros() {
    }

    /* Chamado na validação do modelo */
    protected function setErroMensagem($nome, $mensagem)
    {
        $this->__erros[$nome] = $mensagem;
    }

    /* Chamado pelo controlador */
	public function isValido()
    {
    	$this->__erros = [];
    	$this->verificarErros();
        return empty($this->__erros);
    }

    /* Chamado pelo controlador */
    public function getValidacaoErros()
    {
    	return $this->__erros;
    }
}
