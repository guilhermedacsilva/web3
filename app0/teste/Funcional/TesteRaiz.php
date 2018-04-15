<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;

class TesteRaiz extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar(strpos($resposta['html'], 'Bem-vindo') !== false);
    }
}
