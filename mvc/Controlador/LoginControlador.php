<?php
namespace Controlador;

use \Modelo\Usuario;
use \Lib\DW3Sessao;

const VIEW_LOGIN = PASTA_VISAO . 'login/';

class LoginControlador
{
    public function create()
    {
        require VIEW_LOGIN . 'create.php';
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
