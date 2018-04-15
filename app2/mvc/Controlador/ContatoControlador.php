<?php
namespace Controlador;

use \Modelo\Contato;

class MensagemControlador extends Controlador
{
    public function index()
    {
        $contatos = Contato::buscarTodos();
        $this->visao('contatos/index.php', [
            'contatos' => $contatos
        ]);
    }

    public function armazenar()
    {
        $mensagem = new Contato($_POST['usuario'], $_POST['texto']);
        $mensagem->salvar();
        $this->redirecionar(URL_RAIZ);
    }
}
