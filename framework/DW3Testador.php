<?php
namespace Framework;

class DW3Testador
{
    public function testarTudo()
    {
        $this->rodarTestesUnitarios();
    }

    private function rodarTestesUnitarios()
    {
        $classes = $this->procurarClassesTeste(PASTA_TESTE . 'Unitario');
        foreach ($classes as $classeNome) {
            $classeNomeCompleto = "\\Teste\\Unitario\\$classeNome";
            $objetoTeste = new $classeNomeCompleto();
            $metodos = $this->procurarMetodosTeste($objetoTeste);
            $erros = false;
            echo "$classeNome";
            foreach ($metodos as $metodo) {
                $objetoTeste->recriarBancoDeDados();
                $objetoTeste->antes();
                try {
                    $objetoTeste->$metodo();
                } catch (\Exception $e) {
                    echo "\n    Erro linha: " . $e->getTrace()[0]['line'];
                    $erros = true;
                }
                $objetoTeste->depois();
            }
            if (!$erros) {
                echo ': OK';
            }
            echo "\n";
        }
    }

    /* Retorna os nomes das classes que comecem com 'Teste' */
    private function procurarClassesTeste($pasta)
    {
        $arquivos = scandir($pasta);
        $arquivos = array_filter($arquivos, function($arquivo) {
            return substr($arquivo, 0, 5) === 'Teste';
        });
        return array_map(function($arquivo) {
            return substr($arquivo, 0, -4);
        }, $arquivos);
    }

    /* Retorna o nome dos métodos que comecem com 'teste' */
    private function procurarMetodosTeste($classe)
    {
        $metodos = get_class_methods($classe);
        return array_filter($metodos, function($metodo) {
            return substr($metodo, 0, 5) === 'teste';
        });
    }
}
