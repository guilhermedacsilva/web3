<?php
namespace Framework;

abstract class DW3Controlador
{
	use DW3ControladorVisao;

	private static $deveRedirecionar = true;
	private static $redirecionarUrl;
	protected $visaoConteudo;
	protected $visaoDados;

	protected function redirecionar($url)
	{
		self::$redirecionarUrl = $url;
		if (self::$deveRedirecionar) {
			header("Location: $url");
		}
		throw new DW3RedirecionarException();
	}

	protected function visao(
		$__conteudo,
		$__dados = [],
		$__template = 'index.php')
	{
		extract($__dados);

		if ($__template == null) {
			require PASTA_VISAO . $__conteudo;

		} else {
			$this->visaoConteudo = $__conteudo;
			$this->visaoDados = $__dados;
			require PASTA_VISAO . 'templates/' . $__template;
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

	public static function modoTeste()
	{
		self::$deveRedirecionar = false;
		self::$redirecionarUrl = null;
	}

	public static function getRedirecionarUrl()
	{
		return self::$redirecionarUrl;
	}
}
