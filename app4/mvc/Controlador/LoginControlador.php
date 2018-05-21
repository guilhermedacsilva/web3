<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function criar()
    {
        $this->visao('login/criar.php');
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarEmail($_POST['email']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            $this->redirecionar(URL_RAIZ . 'mensagens');
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
