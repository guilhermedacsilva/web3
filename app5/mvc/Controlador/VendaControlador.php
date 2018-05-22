<?php
namespace Controlador;

use \Modelo\Venda;

class VendaControlador extends Controlador
{
    /*
    public function index()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        $mensagens = Venda::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Venda::contarTodos() / $limit);
        $this->visao('mensagens/index.php', [
            'mensagens' => $mensagens,
            'pagina' => $pagina,
            'ultimaPagina' => $ultimaPagina,
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }
    */

    public function armazenar()
    {
        $mensagem = new Venda(
            DW3Sessao::get('usuario'),
            $_POST['texto']
        );
        if ($mensagem->isValido()) {
            $mensagem->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Venda cadastrada.');
            $this->redirecionar(URL_RAIZ . 'mensagens');

        } else {
            $this->setErros($mensagem->getValidacaoErros());
            $this->visao('mensagens/index.php', [
                'mensagens' => Venda::buscarTodos()
            ]);
        }
    }
}
