<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteRaiz extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar($resposta['redirecionar'] === URL_RAIZ . 'contatos');
    }
}
