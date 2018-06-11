<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Mensagem;

class MensagemControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $mensagens = Mensagem::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Mensagem::contarTodos() / $limit);
        return compact('pagina', 'mensagens', 'ultimaPagina');
    }

    public function index()
    {
        $this->verificarLogado();
        $paginacao = $this->calcularPaginacao();
        $this->visao('mensagens/index.php', [
            'mensagens' => $paginacao['mensagens'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
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
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem cadastrada.');
            $this->redirecionar(URL_RAIZ . 'mensagens');

        } else {
            $paginacao = $this->calcularPaginacao();
            $this->setErros($mensagem->getValidacaoErros());
            $this->visao('mensagens/index.php', [
                'mensagens' => $paginacao['mensagens'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $mensagem = Mensagem::buscarId($id);
        if ($mensagem->getUsuarioId() == $this->getUsuario()) {
            Mensagem::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem destruida.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as mensagens dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'mensagens');
    }
}
