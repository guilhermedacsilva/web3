<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeLogarAdmin()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'admin',
            'senha' => 'admin'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLogarNaoAdmin()
    {
        (new Usuario('Joao', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'Joao',
            'senha' => '123'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes/criar');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeDeslogar()
    {
        (new Usuario('Joao', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'Joao',
            'senha' => '123'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}
