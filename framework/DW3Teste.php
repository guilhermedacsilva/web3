<?php
namespace Framework;

abstract class DW3Teste
{
    public function antes() {}

    public function depois() {}

    public function recriarBancoDeDados()
    {
        $arquivos = scandir(PASTA_SQLS);
        $arquivos = array_filter($arquivos, function($arquivo) {
            return substr($arquivo, -4) === '.sql';
        });
        sort($arquivos);
        DW3BancoDeDados::exec('DROP DATABASE ' . DW3BancoDeDados::getBanco());
        foreach ($arquivos as $arquivo) {
            $comandos = file_get_contents(PASTA_SQLS . $arquivo);
            $comandos = explode(";", $comandos);
            foreach ($comandos as $comando) {
                DW3BancoDeDados::exec($comando);
                DW3BancoDeDados::reconectar();
            }
        }
    }

    protected function verificar($condicao)
    {
        if (!$condicao) {
            throw new \Exception();
        }
    }
}
