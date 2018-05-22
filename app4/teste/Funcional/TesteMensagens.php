<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteMensagens extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'mensagens');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeListagem()
    {
        $this->logar();
        (new Mensagem($this->usuario->getId(), 'Olá'))->salvar();
        $resposta = $this->get(URL_RAIZ . 'mensagens');
        $this->verificarContem($resposta, 'Escreva a mensagem');
        $this->verificarContem($resposta, 'Olá');
    }

    public function testeArmazenarDeslogado()
    {
        $resposta = $this->post(URL_RAIZ . 'mensagens', [
            'texto' => 'Olá deslogado'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeArmazenar()
    {
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'mensagens', [
            'texto' => 'Olá logado'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'mensagens');
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdReclamacoes = $query->fetchAll();
        $this->verificar(count($bdReclamacoes) == 1);
    }

    public function testeDestruir()
    {
        $this->logar();
        $mensagem = new Mensagem($this->usuario->getId(), 'Olá');
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'mensagens/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'mensagens');
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao === false);
    }

    public function testeDestruirDeOutroUsuario()
    {
        $this->logar();
        $outroUsuario = new Usuario('teste2@teste2.com', '123');
        $outroUsuario->salvar();
        $mensagem = new Mensagem($outroUsuario->getId(), 'Olá');
        $mensagem->salvar();
        $resposta = $this->delete(URL_RAIZ . 'mensagens/' . $mensagem->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'mensagens');
        $query = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao !== false);
    }
}
