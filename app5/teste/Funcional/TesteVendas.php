<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteVendas extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'vendas/criar');
        $this->verificarContem($resposta, 'Cadastrar');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'vendas', [
            'produtoId' => '1',
            'quantidade' => '99',
            'precoTotal' => '77.77'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'vendas/criar');
        $query = DW3BancoDeDados::query('SELECT * FROM vendas');
        $bdVendas = $query->fetchAll();
        $this->verificar(count($bdVendas) == 23);
    }
}
