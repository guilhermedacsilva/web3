<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;

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
    }
}
