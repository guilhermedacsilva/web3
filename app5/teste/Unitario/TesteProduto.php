<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Produto;
use \Framework\DW3BancoDeDados;

class TesteProduto extends Teste
{
    public function testeBuscarTodos()
    {
        $produtos = Produto::buscarTodos();
        $this->verificar(count($produtos) == 3);
    }

    public function testeBuscarId()
    {
        $produto = Produto::buscarId(1);
        $this->verificar($produto->getNome() == 'Processador');
    }
}
