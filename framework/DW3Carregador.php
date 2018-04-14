<?php
require_once 'cfg/geral.php';

function iniciaCom($texto, $palavra)
{
	return substr($texto, 0, strlen($palavra)) === $palavra;
}

function carregarArquivoDaClasse($nomeDaClasse)
{
	if (iniciaCom($nomeDaClasse, 'Framework\\')) {
		$nomeDaClasse = substr($nomeDaClasse, 10);
		require_once PASTA_FRAMEWORK . $nomeDaClasse . '.php';

	} elseif (iniciaCom($nomeDaClasse, 'Teste\\')) {
		$nomeDaClasse = substr($nomeDaClasse, 6);
		require_once PASTA_TESTES . $nomeDaClasse . '.php';

	} else {
		require_once PASTA_MVC . str_replace('\\', '/', $nomeDaClasse) . '.php';
	}
}

spl_autoload_register('carregarArquivoDaClasse');
