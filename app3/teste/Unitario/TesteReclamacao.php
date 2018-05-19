<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Reclamacao;
use \Framework\DW3BancoDeDados;

class TesteReclamacao extends Teste
{
    private $usuarioId;

    /* Roda antes de cada teste */
    public function antes()
    {
        $usuario = new Usuario('Jonas', '123');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeArmazenar()
    {
        $reclamacao = new Reclamacao('2000-01-01', 'UTFPR', 'desc', $this->usuarioId);
        $reclamacao->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM reclamacoes');
        $bdReclamacoes = $query->fetchAll();
        $this->verificar(count($bdReclamacoes) == 1);
    }

    public function testeAtualizar()
    {
        $reclamacao = new Reclamacao('2000-01-01', 'UTFPR', 'desc', $this->usuarioId);
        $reclamacao->salvar();
        $reclamacao->setDataAtendimento();
        $reclamacao->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM reclamacoes');
        $bdReclamacao = $query->fetch();
        $this->verificar($bdReclamacao['data_atendimento'] != null);
    }

    public function testeBuscarId()
    {
        $reclamacao = new Reclamacao('2000-01-01', 'UTFPR', 'desc', $this->usuarioId);
        $reclamacao->salvar();
        $reclamacao2 = Reclamacao::buscarId($reclamacao->getId());
        $this->verificar($reclamacao->getLocal() == $reclamacao2->getLocal());
    }

    public function testeBuscarNaoAtendidos()
    {
        $reclamacao = new Reclamacao('2000-01-01', 'UTFPR', 'desc', $this->usuarioId);
        $reclamacao->salvar();
        $reclamacao->setDataAtendimento();
        $reclamacao->salvar();

        $reclamacao = new Reclamacao('2001-01-01', 'UNICENTRO', 'desc 2', $this->usuarioId);
        $reclamacao->salvar();

        $reclamacoes = Reclamacao::buscarNaoAtendidos();
        $this->verificar(count($reclamacoes) == 1);
    }
}
