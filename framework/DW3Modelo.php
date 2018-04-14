<?php
namespace Framework;

abstract class DW3Modelo
{
	protected $__erros = [];

    /* Use $this->setErroMensagem() quando encontrar um erro */
    protected function verificarErros() {
    }

	public function isValido()
    {
    	$this->__erros = [];
    	$this->verificarErros();
        return empty($this->__erros);
    }

    protected function setErroMensagem($nome, $mensagem)
    {
    	$this->__erros[$nome] = $mensagem;
    }

    public function getValidacaoErros()
    {
    	return $this->__erros;
    }
}
