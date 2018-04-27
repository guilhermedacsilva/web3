<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Framework\DW3BancoDeDados;

class TesteRaiz extends Teste
{
    public function testeAcessarSemDados()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Chat Online') !== false);
    }

    public function testeAcessarComDados()
    {
        (new Mensagem('Joao', 'Mensagem teste'))->salvar();
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Mensagem teste') !== false);
    }

    public function testeCadastrar()
    {
        $resposta = $this->post(URL_RAIZ, [
            'usuario' => 'Mario',
            'texto' => 'Blz?'
        ]);
        $this->verificar($resposta['redirecionar'] == URL_RAIZ);
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Blz?') !== false);
        /*
        $resultado = DW3BancoDeDados::query('SELECT * FROM mensagens');
        $mensagem = $resultado->fetch();
        $this->verificar($mensagem['texto'] === 'Blz?');
        */
    }
}
