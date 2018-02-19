<?php
namespace Controlador;

use \Lib\DW3Sessao;
use \Modelo\Mensagem;

class MensagemControlador
{
    public function index()
    {
        $this->verificarLogado();
        $mensagens = Mensagem::all();
        require PASTA_VISAO . 'mensagens/index.php';
    }

    public function store()
    {
        $this->verificarLogado();
        $mensagem = new Mensagem(
            DW3Sessao::get('usuario'),
            $_POST['texto']
        );
        $mensagem->save();
        header('Location: ' . URL_RAIZ . 'mensagens');
        exit;
    }

    private function verificarLogado()
    {
        if (DW3Sessao::get('usuario') === null) {
            header('Location: ' . URL_RAIZ . 'login');
            exit;
        }
    }
}
