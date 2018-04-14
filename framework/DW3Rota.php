<?php
namespace Framework;

class DW3Rota
{
	private $controlador;
	private $metodo;
	private $parametros;

	public function __construct($rotaString, $parametros = [])
	{
		$controladorArray = explode('#', $rotaString);
        $this->controlador = $controladorArray[0];
        $this->metodo = $controladorArray[1];
        $this->parametros = $parametros;
	}

	public function getControlador()
	{
		return $this->controlador;
	}

	public function getMetodo()
	{
		return $this->metodo;
	}

	public function getParametros()
	{
		return $this->parametros;
	}
}
