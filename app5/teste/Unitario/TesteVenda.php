<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Venda;
use \Framework\DW3BancoDeDados;

class TesteVenda extends Teste
{
    public function testeInserir()
    {
        $venda = new Venda(1, 1, 200);
        $venda->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM vendas WHERE id = " . $venda->getId());
        $bdVenda = $query->fetch();
        $this->verificar($bdVenda['quantidade'] == 1);
    }

    public function testeInserirValidacao()
    {
        $venda = new Venda(0, 0, -1);
        $venda->isValido();
        $this->verificar(count($venda->getValidacaoErros()) == 3);
    }
}
