<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;

class TesteLogin extends Teste
{
    public function testeRedirecionarRaizLogin()
    {
        $resposta = $this->get(URL_RAIZ);
        $this->verificar($resposta['redirecionar'] == URL_RAIZ.'login');
    }

    public function testeAcessarLogin()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificar(strpos($resposta['html'], 'Login') !== false);
    }

    public function testeLogin()
    {
        $usuario = new Usuario('joao', '1234', null);
        $usuario->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao',
            'senha' => '1234'
        ]);
        $this->verificar($resposta['redirecionar'] == URL_RAIZ . 'mensagens');
        $resposta = $this->get(URL_RAIZ . 'mensagens');
        $this->verificar(strpos($resposta['html'], '<h2>Escreva a mensagem</h2>') !== false);
    }

    public function testeLogout()
    {
        $usuario = new Usuario('joao', '1234', null);
        $usuario->salvar();
        $_SESSION = ['usuario' => '1'];
        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificar(!array_key_exists('usuario', $_SESSION));
        $this->verificar($resposta['redirecionar'] == URL_RAIZ . 'login');
    }
}
