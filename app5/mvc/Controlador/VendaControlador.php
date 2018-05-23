<?php
namespace Controlador;

use \Modelo\Venda;
use \Modelo\Produto;
use \Framework\DW3Sessao;

class VendaControlador extends Controlador
{
    public function criar()
    {
        $this->visao('vendas/criar.php', [
            'produtos' => Produto::buscarTodos(),
            'sucesso' => DW3Sessao::getFlash('sucesso')
        ]);
    }

    public function armazenar()
    {
        $venda = new Venda(
            $_POST['produtoId'],
            $_POST['quantidade'],
            $_POST['precoTotal']
        );

        if ($venda->isValido()) {
            $venda->salvar();
            DW3Sessao::setFlash('sucesso', 'Venda cadastrada.');
            $this->redirecionar(URL_RAIZ . 'vendas/criar');
        } else {
            $this->setErros($venda->getValidacaoErros());
            $this->visao('vendas/criar.php', [
                'produtos' => Produto::buscarTodos(),
                'sucesso' => null
            ]);
        }
    }
}
