<?php
namespace Controller;

use \Framework\Sessao;
use \Model\Mensagem;

class MensagemController
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
            Sessao::get('usuario'),
            $_POST['texto']
        );
        $mensagem->save();
        header('Location: ' . URL_RAIZ . 'mensagens');
        exit;
    }

    private function verificarLogado()
    {
        if (Sessao::get('usuario') === null) {
            header('Location: ' . URL_RAIZ . 'login');
            exit;
        }
    }
}
