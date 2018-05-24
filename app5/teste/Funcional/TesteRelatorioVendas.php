<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteRelatorioVendas extends Teste
{
    public function testeIndex()
    {
        $resposta = $this->get(URL_RAIZ . 'relatorios/venda');
        $this->verificarContem($resposta, 'Preço Total');
        $this->verificarContem($resposta, '39');
        $this->verificarContem($resposta, '22.075,00');
    }

    public function testeFiltro()
    {
        $resposta = $this->get(URL_RAIZ . 'relatorios/venda', [
            'produtoId' => '3',
            'quantidadeMin' => '2',
            'quantidadeMax' => '2',
            'precoTotalMin' => '2800',
            'precoTotalMax' => '3000'
        ]);
        $this->verificarContem($resposta, 'Preço Total');
        $this->verificarContem($resposta, '2');
        $this->verificarContem($resposta, '2.900,00');
        $this->verificarNaoContem($resposta, '3.500,00');
        $this->verificarNaoContem($resposta, '1.500,00');
        $this->verificarNaoContem($resposta, '400,00');
    }
}
