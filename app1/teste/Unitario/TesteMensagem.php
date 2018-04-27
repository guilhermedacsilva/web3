<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteMensagem extends Teste
{
    public function testeInserir()
    {
        $mensagem = new Mensagem('Pedro', 'Ola pessoal');
        $mensagem->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem['texto'] === $mensagem->getTexto());
    }

    public function testeBuscarTodos()
    {
        (new Mensagem('Maria', 'Ola pessoal'))->salvar();
        (new Mensagem('José', 'Segunda mensagem'))->salvar();
        $mensagens = Mensagem::buscarTodos();
        $this->verificar(count($mensagens) == 2);
    }
}
