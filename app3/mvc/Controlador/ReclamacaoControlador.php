<?php
namespace Controlador;

use \Modelo\Reclamacao;
use \Modelo\Usuario;

class ReclamacaoControlador extends Controlador
{
    public function index()
    {
        $this->verificarLogado(true);
        $reclamacoes = Reclamacao::buscarNaoAtendidos();
        $this->visao('reclamacoes/index.php', [
            'reclamacoes' => $reclamacoes
        ]);
    }

    public function criar()
    {
        $this->verificarLogado();
        $this->visao('reclamacoes/criar.php', [
            'usuario' => $this->getUsuario()
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
        $this->redirecionar(URL_RAIZ . 'reclamacoes/criar');
    }

    public function atualizar($id)
    {
        $this->verificarLogado(true);
        $reclamacao = Reclamacao::buscarId($id);
        $reclamacao->setDataAtendimento();
        $reclamacao->salvar();
        $this->redirecionar(URL_RAIZ . 'reclamacoes');
    }
}
