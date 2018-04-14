<?php
namespace Framework;

class DW3Testador
{
    public function testarTudo()
    {
        $this->rodarTestes('Unitario');
        $this->rodarTestes('Funcional');
    }

    private function rodarTestes($tipo)
    {
        $classes = $this->procurarClassesTeste(PASTA_TESTE . $tipo);
        foreach ($classes as $classeNome) {
            $this->rodarClasse($classeNome, $tipo);
        }
    }

    private function rodarClasse($classeNome, $tipo)
    {
        $classeNomeCompleto = "\\Teste\\$tipo\\$classeNome";
        $objetoTeste = new $classeNomeCompleto();
        $metodos = $this->procurarMetodosTeste($objetoTeste);
        $erros = false;
        echo "$classeNome";
        foreach ($metodos as $metodo) {
            $this->rodarMetodos($objetoTeste, $metodo);
        }
        if (!$erros) {
            echo ': ' . count($metodos) . ' OK';
        }
        echo "\n";
    }

    private function rodarMetodos($objetoTeste, $metodo)
    {
        DW3Sessao::modoTeste();
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
