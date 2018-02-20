<?php
namespace Controlador;

use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{
    public function create()
    {
        $this->visao('usuarios/create.php');
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
        $this->visao('usuarios/sucesso.php');
    }
}
