<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Mensagem;

class MensagemControlador extends Controlador
{
    public function index()
    {
        if ($this->verificarLogado()) {
            $mensagens = Mensagem::buscarTodos();
            $this->visao('mensagens/index.php', [
                'mensagens' => $mensagens
            ]);
        }
    }

    public function armazenar()
    {
        if ($this->verificarLogado()) {
            $mensagem = new Mensagem(
                DW3Sessao::get('usuario'),
                $_POST['texto']
            );
            if ($mensagem->isValido()) {
                $mensagem->salvar();
                $this->redirecionar(URL_RAIZ . 'mensagens');

            } else {
                $this->setErros($mensagem->getValidacaoErros());
                $this->visao('mensagens/index.php', [
                    'mensagens' => Mensagem::buscarTodos()
                ]);
            }
        }
    }

    public function destruir($id)
    {
        if ($this->verificarLogado()) {
            Mensagem::destruir($id);
            $this->redirecionar(URL_RAIZ . 'mensagens');
        }
    }
}
