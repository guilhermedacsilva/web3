<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Reclamacao;

class TesteReclamacoes extends Teste
{
    public function testeListagemDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'reclamacoes');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    /*
    public function testeIndexComDados()
    {
        (new Reclamacao('Joao', 'Rua Z', '11', '22', '33'))->salvar();
        $resposta = $this->get(URL_RAIZ . 'reclamacoes');
        $this->verificarContem($resposta, 'Joao');
        $this->verificarContem($resposta, 'Rua Z');
        $this->verificarContem($resposta, '11');
        $this->verificarContem($resposta, '22');
        $this->verificarContem($resposta, '33');
    }

    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'reclamacoes/criar');
        $this->verificarContem($resposta, 'Cadastro de Reclamacao');
    }

    public function testeEditar()
    {
        $reclamacao = new Reclamacao('Joao', 'Rua Z', '11', '22', '33');
        $reclamacao->salvar();
        $resposta = $this->get(URL_RAIZ . 'reclamacoes/' . $reclamacao->getId() . '/editar');
        $this->verificarContem($resposta, 'Edição de Reclamacao');
        $this->verificarContem($resposta, $reclamacao->getNome());
        $this->verificarContem($resposta, $reclamacao->getEndereco());
        $this->verificarContem($resposta, $reclamacao->getTelefone1());
        $this->verificarContem($resposta, $reclamacao->getTelefone2());
        $this->verificarContem($resposta, $reclamacao->getTelefone3());
    }

    public function testeMostrar()
    {
        $reclamacao = new Reclamacao('Joao', 'Rua Z', '11', '22', '33');
        $reclamacao->salvar();
        $resposta = $this->get(URL_RAIZ . 'reclamacoes/' . $reclamacao->getId());
        $this->verificarContem($resposta, 'Mostrando Reclamacao');
        $this->verificarContem($resposta, $reclamacao->getNome());
        $this->verificarContem($resposta, $reclamacao->getEndereco());
        $this->verificarContem($resposta, $reclamacao->getTelefone1());
        $this->verificarContem($resposta, $reclamacao->getTelefone2());
        $this->verificarContem($resposta, $reclamacao->getTelefone3());
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'reclamacoes', [
            'nome' => 'Mario',
            'endereco' => 'Rua A',
            'telefone1' => '11',
            'telefone2' => '22',
            'telefone3' => '33',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes');
        $resposta = $this->get(URL_RAIZ . 'reclamacoes');
        $this->verificarContem($resposta, 'Mario');
        $this->verificarContem($resposta, 'Rua A');
        $this->verificarContem($resposta, '11');
        $this->verificarContem($resposta, '22');
        $this->verificarContem($resposta, '33');
    }

    public function testeAtualizar()
    {
        $reclamacao = new Reclamacao('Joao', 'Rua Z', '11', '22', '33');
        $reclamacao->salvar();
        $resposta = $this->patch(URL_RAIZ . 'reclamacoes/' . $reclamacao->getId(), [
            'nome' => 'Mario',
            'endereco' => 'Rua A',
            'telefone1' => '44',
            'telefone2' => '55',
            'telefone3' => '66',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes');
        $resposta = $this->get(URL_RAIZ . 'reclamacoes');
        $this->verificarContem($resposta, 'Mario');
        $this->verificarContem($resposta, 'Rua A');
        $this->verificarContem($resposta, '44');
        $this->verificarContem($resposta, '55');
        $this->verificarContem($resposta, '66');
    }

    public function testeDestruir()
    {
        $reclamacao = new Reclamacao('Joao', 'Rua Z', '11', '22', '33');
        $reclamacao->salvar();
        $resposta = $this->delete(URL_RAIZ . 'reclamacoes/' . $reclamacao->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes');
        $resposta = $this->get(URL_RAIZ . 'reclamacoes');
        $this->verificarNaoContem($resposta, 'Joao');
    }
    */
}
