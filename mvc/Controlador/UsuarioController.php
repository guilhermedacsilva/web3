<?php
namespace Controller;

use \Model\Usuario;

const VIEW_USUARIO = PASTA_VISAO . 'usuarios/';

class UsuarioController
{
    public function create()
    {
        require VIEW_USUARIO . 'create.php';
    }

    public function store()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        $usuario = new Usuario(
            $_POST['email'],
            $_POST['senha'],
            $foto
        );
        $usuario->save();
        header('Location: ' . URL_RAIZ . 'usuarios/sucesso');
        exit;
    }

    public function sucesso()
    {
        require VIEW_USUARIO . 'sucesso.php';
    }
}
