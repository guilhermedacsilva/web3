<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;

class TesteLogin extends Teste
{
    public function testeRedirecionarRaizLogin()
    {
        $resposta = $this->get('/');
        $this->verificar($resposta['redirecionar'] == '/web3/ex1/login');
    }

    public function testeAcessarLogin()
    {
        $resposta = $this->get('/login');
        $this->verificar(strpos($resposta['html'], 'Login') !== false);
    }

    public function testeLogar()
    {
        $usuario = new Usuario('joao', '1234', null);
        $usuario->salvar();
        $resposta = $this->post('/login', [
            'email' => 'joao',
            'senha' => '1234'
        ]);

    }
}
