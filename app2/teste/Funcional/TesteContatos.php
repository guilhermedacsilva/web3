<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Contato;

class TesteContatos extends Teste
{
    public function testeAcessarSemDados()
    {
        $resposta = $this->get(URL_RAIZ . 'contatos');
        $this->verificar(strpos($resposta['html'], 'Nenhum contato') !== false);
    }

    public function testeAcessarComDados()
    {
        (new Contato('Joao', 'Rua Z', '11', '22', '33'))->salvar();
        $resposta = $this->get(URL_RAIZ . 'contatos');
        $this->verificar(strpos($resposta['html'], 'Joao') !== false);
    }
/*
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
    */
}
