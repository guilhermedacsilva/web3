<?php
namespace Framework;

trait DW3ControladorVisao
{
	protected $erros = [];

	protected function temErro($campoNome)
	{
		return array_key_exists($campoNome, $this->erros);
	}

	protected function getErroCss($campoNome)
	{
		return $this->temErro($campoNome) ? 'has-error' : '';
	}

	protected function getErro($campoNome)
	{
		return $this->temErro($campoNome) ? $this->erros[$campoNome] : '';
	}

	protected function setErros($erros)
	{
		$this->erros = $erros;
	}

	/* Verifica e recupera o campo enviado por POST */
	protected function getPost($campoNome)
	{
		return array_key_exists($campoNome, $_POST) ? $_POST[$campoNome] : '';
	}
}
