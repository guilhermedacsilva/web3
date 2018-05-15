<?php
namespace Controlador;

use \Modelo\Reclamacao;
use \Framework\DW3Sessao;

class ReclamacaoControlador extends Controlador
{
    public function index()
    {
        $this->verificarLogado(true);
        $reclamacoes = Reclamacao::buscarNaoAtendidos();
        $this->visao('reclamacoes/index.php', [
            'reclamacoes' => $reclamacoes,
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ], 'admin.php');
    }

    public function criar()
    {
        $this->verificarLogado();
        $this->visao('reclamacoes/criar.php', [
            'usuario' => $this->getUsuario(),
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $reclamacao = new Reclamacao(
            $_POST['dataIncidente'],
            $_POST['local'],
            $_POST['descricao'],
            $this->getUsuario()->getId()
        );
        $reclamacao->salvar();
        DW3Sessao::setFlash('mensagem', 'Reclamação cadastrada com sucesso.');
        $this->redirecionar(URL_RAIZ . 'reclamacoes/criar');
    }

    public function atualizar($id)
    {
        $this->verificarLogado(true);
        $reclamacao = Reclamacao::buscarId($id);
        $reclamacao->setDataAtendimento();
        $reclamacao->salvar();
        DW3Sessao::setFlash('mensagem', 'Reclamação atendida com sucesso.');
        $this->redirecionar(URL_RAIZ . 'reclamacoes');
    }
}
