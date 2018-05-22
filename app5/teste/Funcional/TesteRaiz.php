<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteRaiz extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }
}
