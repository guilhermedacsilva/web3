<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Login');
    }

    public function testeLogarAdmin()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'admin',
            'senha' => 'admin'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes');
    }

    public function testeLogarNaoAdmin()
    {
        (new Usuario('Joao', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'Joao',
            'senha' => '123'
        ]);
        //$this->verificarRedirecionar($resposta, URL_RAIZ . 'reclamacoes/criar');
    }

    /*
    public function testeIndexSemDados()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Nenhum contato');
    }

    public function testeIndexComDados()
    {
        (new Contato('Joao', 'Rua Z', '11', '22', '33'))->salvar();
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Joao');
        $this->verificarContem($resposta, 'Rua Z');
        $this->verificarContem($resposta, '11');
        $this->verificarContem($resposta, '22');
        $this->verificarContem($resposta, '33');
    }

    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'login/criar');
        $this->verificarContem($resposta, 'Cadastro de Contato');
    }

    public function testeEditar()
    {
        $contato = new Contato('Joao', 'Rua Z', '11', '22', '33');
        $contato->salvar();
        $resposta = $this->get(URL_RAIZ . 'login/' . $contato->getId() . '/editar');
        $this->verificarContem($resposta, 'Edição de Contato');
        $this->verificarContem($resposta, $contato->getNome());
        $this->verificarContem($resposta, $contato->getEndereco());
        $this->verificarContem($resposta, $contato->getTelefone1());
        $this->verificarContem($resposta, $contato->getTelefone2());
        $this->verificarContem($resposta, $contato->getTelefone3());
    }

    public function testeMostrar()
    {
        $contato = new Contato('Joao', 'Rua Z', '11', '22', '33');
        $contato->salvar();
        $resposta = $this->get(URL_RAIZ . 'login/' . $contato->getId());
        $this->verificarContem($resposta, 'Mostrando Contato');
        $this->verificarContem($resposta, $contato->getNome());
        $this->verificarContem($resposta, $contato->getEndereco());
        $this->verificarContem($resposta, $contato->getTelefone1());
        $this->verificarContem($resposta, $contato->getTelefone2());
        $this->verificarContem($resposta, $contato->getTelefone3());
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'nome' => 'Mario',
            'endereco' => 'Rua A',
            'telefone1' => '11',
            'telefone2' => '22',
            'telefone3' => '33',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Mario');
        $this->verificarContem($resposta, 'Rua A');
        $this->verificarContem($resposta, '11');
        $this->verificarContem($resposta, '22');
        $this->verificarContem($resposta, '33');
    }

    public function testeAtualizar()
    {
        $contato = new Contato('Joao', 'Rua Z', '11', '22', '33');
        $contato->salvar();
        $resposta = $this->patch(URL_RAIZ . 'login/' . $contato->getId(), [
            'nome' => 'Mario',
            'endereco' => 'Rua A',
            'telefone1' => '44',
            'telefone2' => '55',
            'telefone3' => '66',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Mario');
        $this->verificarContem($resposta, 'Rua A');
        $this->verificarContem($resposta, '44');
        $this->verificarContem($resposta, '55');
        $this->verificarContem($resposta, '66');
    }

    public function testeDestruir()
    {
        $contato = new Contato('Joao', 'Rua Z', '11', '22', '33');
        $contato->salvar();
        $resposta = $this->delete(URL_RAIZ . 'login/' . $contato->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarNaoContem($resposta, 'Joao');
    }
    */
}
