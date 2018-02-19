<?php
namespace Controlador;

use \Lib\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function create()
    {
        $this->visao('login/create.php');
    }

    public function store()
    {
        $usuario = Usuario::findEmail($_POST['email']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            header('Location: ' . URL_RAIZ . 'mensagens');
        } else {
            header('Location: ' . URL_RAIZ . 'login');
        }
        exit;
    }

    public function destroy()
    {
        DW3Sessao::deletar('usuario');
        header('Location: ' . URL_RAIZ . 'login');
        exit;
    }
}
