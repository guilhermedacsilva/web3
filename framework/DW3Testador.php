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
            foreach ($metodos as $metodo) {
                $objetoTeste->recriarBancoDeDados();
                $objetoTeste->antes();
                $objetoTeste->$metodo();
                $objetoTeste->depois();
            }
        }
    }

    /* Retorna os nomes das classes */
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

    private function procurarMetodosTeste($classe)
    {
        $metodos = get_class_methods($classe);
        return array_filter($metodos, function($metodo) {
            return substr($metodo, 0, 5) === 'teste';
        });
    }
}
