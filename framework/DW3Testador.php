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
        echo "-- $tipo -------------------------\n";
        foreach ($classes as $classeNome) {
            $this->rodarClasse($classeNome, $tipo);
        }
    }

    private function rodarClasse($classeNome, $tipo)
    {
        $classeNomeCompleto = "\\Teste\\$tipo\\$classeNome";
        $objetoTeste = new $classeNomeCompleto();
        $metodos = $this->procurarMetodosTeste($objetoTeste);
        $erros = 0;
        echo "$classeNome";
        foreach ($metodos as $metodo) {
            $erros += $this->rodarMetodos($objetoTeste, $metodo);
        }
        if ($erros == 0) {
            echo ': ' . count($metodos) . ' OK';
        }
        echo "\n";
    }

    private function rodarMetodos($objetoTeste, $metodo)
    {
        DW3Sessao::modoTeste();
        $objetoTeste->recriarBancoDeDados();
        $objetoTeste->antes();
        $erros = 0;
        try {
            $objetoTeste->$metodo();
        } catch (DW3VerificarException $e) {
            echo "\n    Erro linha: " . $e->getTrace()[0]['line'];
            $erros = 1;
        } catch (\Exception $e) {
            echo "\n    Erro linha: " . $e->getLine();
            echo " no arquivo " . $e->getFile();
            echo "\n    " . $e->getMessage();
            $erros = 1;
        }
        $objetoTeste->depois();
        return $erros;
    }

    /* Retorna os nomes das classes que comecem com 'Teste' */
    private function procurarClassesTeste($pasta)
    {
        if (!is_dir($pasta)) {
            return [];
        }
        $arquivos = scandir($pasta);
        $arquivos = array_filter($arquivos, function($arquivo) {
            return iniciaCom($arquivo, 'Teste');
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
            return iniciaCom($metodo, 'teste');
        });
    }
}
