<?php
require_once 'cfg/geral.php';

function iniciaCom($texto, $palavra)
{
	return substr($texto, 0, strlen($palavra)) === $palavra;
}

function carregarArquivoDaClasse($nomeDaClasse)
{
	$nomeDaClasse = str_replace('\\', '/', $nomeDaClasse);

	if (iniciaCom($nomeDaClasse, 'Framework/')) {
		$nomeDaClasse = substr($nomeDaClasse, 10);
		require_once PASTA_FRAMEWORK . $nomeDaClasse . '.php';

	} elseif (iniciaCom($nomeDaClasse, 'Teste/')) {
		$nomeDaClasse = substr($nomeDaClasse, 6);
		require_once PASTA_TESTE . $nomeDaClasse . '.php';

	} else {
		require_once PASTA_MVC . $nomeDaClasse . '.php';
	}
}

spl_autoload_register('carregarArquivoDaClasse');
