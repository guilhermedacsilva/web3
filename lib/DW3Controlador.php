<?php
namespace Lib;

abstract class DW3Controlador
{
	use DW3ControladorVisao;

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

	/* dados: deve ser um vetor com chaves e valores
	*/
	protected function incluirVisao($__nomeArquivo, $__dados = [])
	{
		extract($this->visaoDados);
		extract($__dados);
		require PASTA_VISAO . $__nomeArquivo;
	}
}
