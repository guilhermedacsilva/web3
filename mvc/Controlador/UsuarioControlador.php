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
        $usuario = new Usuario($_POST['email'], $_POST['senha'], $foto);

        if ($usuario->isValido()) {
            $usuario->save();
            header('Location: ' . URL_RAIZ . 'usuarios/sucesso');
            exit;

        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/create.php');
        }
    }

    public function sucesso()
    {
        $this->visao('usuarios/sucesso.php');
    }
}
