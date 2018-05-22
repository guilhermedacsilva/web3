<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteMensagem extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('email-teste', 'senha');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeInserir()
    {
        $mensagem = new Mensagem($this->usuarioId, 'Ola pessoal');
        $mensagem->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM mensagens WHERE id = " . $mensagem->getId());
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem['texto'] === $mensagem->getTexto());
    }

    public function testeBuscarTodos()
    {
        (new Mensagem($this->usuarioId, 'Ola pessoal'))->salvar();
        (new Mensagem($this->usuarioId, 'Segunda mensagem'))->salvar();
        $mensagens = Mensagem::buscarTodos();
        $this->verificar(count($mensagens) == 2);
    }

    public function testeContarTodos()
    {
        (new Mensagem($this->usuarioId, 'Ola pessoal'))->salvar();
        (new Mensagem($this->usuarioId, 'Segunda mensagem'))->salvar();
        $total = Mensagem::contarTodos();
        $this->verificar($total == 2);
    }

    public function testeDestruir()
    {
        $mensagem = new Mensagem($this->usuarioId, 'Ola pessoal');
        $mensagem->salvar();
        Mensagem::destruir($mensagem->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem === false);
    }
}
