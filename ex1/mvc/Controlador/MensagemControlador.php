<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Mensagem;

class MensagemControlador extends Controlador
{
    public function index()
    {
        $this->verificarLogado();
        $mensagens = Mensagem::buscarTodos();
        $this->visao('mensagens/index.php', [
            'mensagens' => $mensagens
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $mensagem = new Mensagem(
            DW3Sessao::get('usuario'),
            $_POST['texto']
        );
        if ($mensagem->isValido()) {
            $mensagem->salvar();
            header('Location: ' . URL_RAIZ . 'mensagens');
            exit;

        } else {
            $this->setErros($mensagem->getValidacaoErros());
            $this->visao('mensagens/index.php', [
                'mensagens' => Mensagem::buscarTodos()
            ]);
        }
    }

    public function destruir($id)
    {
        Mensagem::destruir($id);
        header('Location: ' . URL_RAIZ . 'mensagens');
        exit;
    }
}
