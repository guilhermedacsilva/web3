<?php
namespace Lib;

class DW3Controlador
{
	protected $visaoTemplate = 'index.php';
	protected $visaoConteudo;
	protected $visaoDados;

	protected function visao($__conteudo, $__dados = [])
	{
		extract($__dados);

		if ($this->visaoTemplate == null) {
			require PASTA_VISAO . $__conteudo;

		} else {
			$this->visaoConteudo = $__conteudo;
			$this->visaoDados = $__dados;
			require PASTA_VISAO . 'templates/' . $this->visaoTemplate;
		}
	}

	protected function imprimirConteudo()
	{
		extract($this->visaoDados);
		require PASTA_VISAO . $this->visaoConteudo;
	}
}
