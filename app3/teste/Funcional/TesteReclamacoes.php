<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Reclamacao;
use \Framework\DW3BancoDeDados;

class TesteReclamacoes extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'reclamacoes');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeListagem()
    {
        $this->logarAdmin();
        (new Reclamacao('2000-01-01', 'UTFPR', 'desc', 1))->salvar();
        $resposta = $this->get(URL_RAIZ . 'reclamacoes');
        $this->verificarContem($resposta, 'Reclamações');
        $this->verificarContem($resposta, 'UTFPR');
    }

    public function testeAtualizar()
    {
        $this->logarAdmin();
        $reclamacao = new Reclamacao('2000-01-01', 'UTFPR', 'desc', 1);
        $reclamacao->salvar();
        $resposta = $this->patch(URL_RAIZ . 'reclamacoes/' . $reclamacao->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes');
        $resposta = $this->get(URL_RAIZ . 'reclamacoes');
        $this->verificarContem($resposta, 'Nenhuma reclamação encontrada');
        $this->verificarContem($resposta, 'Reclamação atendida com sucesso');
    }

    public function testeCriarDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'reclamacoes/criar');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeCriar()
    {
        $this->logarNormal();
        $resposta = $this->get(URL_RAIZ . 'reclamacoes/criar');
        $this->verificarContem($resposta, 'Cadastro de Reclamação');
    }

    public function testeArmazenar()
    {
        $this->logarNormal();
        $resposta = $this->post(URL_RAIZ . 'reclamacoes', [
            'dataIncidente' => '2000-01-01',
            'local' => 'Rua A',
            'descricao' => 'desc',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes/criar');
        $resposta = $this->get(URL_RAIZ . 'reclamacoes/criar');
        $this->verificarContem($resposta, 'Reclamação cadastrada com sucesso');
        $query = DW3BancoDeDados::query('SELECT * FROM reclamacoes');
        $bdReclamacoes = $query->fetchAll();
        $this->verificar(count($bdReclamacoes) == 1);
    }
}
