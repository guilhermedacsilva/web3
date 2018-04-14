<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteMensagem extends Teste
{
    public function testeInserir()
    {
        $usuario = new Usuario('email-teste', 'senha', null);
        $usuario->salvar();
        $mensagem = new Mensagem($usuario->getId(), 'Ola pessoal');
        $mensagem->salvar();
        $query = DW3BancoDeDados::getPdo()->query("SELECT * FROM mensagens WHERE usuario_id = " . $usuario->getId());
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem['texto'] === $mensagem->getTexto());
    }

    public function testeBuscarTodos()
    {
        $usuario = new Usuario('email-teste', 'senha', null);
        $usuario->salvar();
        (new Mensagem($usuario->getId(), 'Ola pessoal'))->salvar();
        (new Mensagem($usuario->getId(), 'Segunda mensagem'))->salvar();
        $mensagens = Mensagem::buscarTodos();
        $this->verificar(count($mensagens) == 2);
    }

    public function testeDestruir()
    {
        $usuario = new Usuario('email-teste', 'senha', null);
        $usuario->salvar();
        $mensagem = new Mensagem($usuario->getId(), 'Ola pessoal');
        $mensagem->salvar();
        Mensagem::destruir($mensagem->getId());
        $query = DW3BancoDeDados::getPdo()->query('SELECT * FROM mensagens');
        $bdMensagem = $query->fetch();
        $this->verificar($bdMensagem === false);
    }
}
