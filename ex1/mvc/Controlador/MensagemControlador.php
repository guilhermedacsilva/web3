<?php
namespace Controlador;

use \Modelo\Mensagem;

class MensagemControlador extends Controlador
{
    public function index()
    {
        $mensagens = Mensagem::buscarTodos();
        $this->visao('mensagens/index.php', [
            'mensagens' => $mensagens
        ]);
    }

    public function armazenar()
    {
        $mensagem = new Mensagem($_POST['usuario'], $_POST['texto']);
        $mensagem->salvar();
        $this->redirecionar(URL_RAIZ);
    }
}
