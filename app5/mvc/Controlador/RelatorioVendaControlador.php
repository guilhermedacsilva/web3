<?php
namespace Controlador;

use \Modelo\Produto;
use \Modelo\RelatorioVenda;

class RelatorioVendaControlador extends Controlador
{
    public function index()
    {
        $this->visao('relatorios/venda.php', [
            'produtos' => Produto::buscarTodos(),
            'registros' => RelatorioVenda::buscarRegistros($_GET)
        ]);
    }
}
