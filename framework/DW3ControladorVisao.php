<?php
namespace Framework;

trait DW3ControladorVisao
{
	protected $erros = [];

	/* Deve ser passado o getValidacaoErros() do modelo */
	protected function setErros($erros)
	{
		$this->erros = $erros;
	}

	/* Usado na visão para saber se o campo possui um erro */
	protected function temErro($campoNome)
	{
		return array_key_exists($campoNome, $this->erros);
	}

	/* Caso o campo tenha um erro, retorna a mensagem de erro */
	protected function getErro($campoNome)
	{
		return $this->temErro($campoNome) ? $this->erros[$campoNome] : '';
	}

	/* Caso o campo tenha sido enviado por POST, retorna o seu valor */
	protected function getPost($campoNome)
	{
		return array_key_exists($campoNome, $_POST) ? $_POST[$campoNome] : '';
	}

	/* Caso o campo tenha sido enviado por GET, retorna o seu valor */
	protected function getGet($campoNome)
	{
		return array_key_exists($campoNome, $_GET) ? $_GET[$campoNome] : '';
	}
}
