<?php
require_once 'cfg/geral.php';

function carregarArquivoDaClasse($nomeDaClasse)
{
    require_once PASTA_RAIZ . str_replace('\\', '/', $nomeDaClasse) . '.php';
}

spl_autoload_register('carregarArquivoDaClasse');
