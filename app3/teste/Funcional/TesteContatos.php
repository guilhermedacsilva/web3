<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Contato;

class TesteContatos extends Teste
{
    public function testeIndexSemDados()
    {
        $resposta = $this->get(URL_RAIZ . 'contatos');
        $this->verificarContem($resposta, 'Nenhum contato');
    }

    public function testeIndexComDados()
    {
        (new Contato('Joao', 'Rua Z', '11', '22', '33'))->salvar();
        $resposta = $this->get(URL_RAIZ . 'contatos');
        $this->verificarContem($resposta, 'Joao');
        $this->verificarContem($resposta, 'Rua Z');
        $this->verificarContem($resposta, '11');
        $this->verificarContem($resposta, '22');
        $this->verificarContem($resposta, '33');
    }

    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'contatos/criar');
        $this->verificarContem($resposta, 'Cadastro de Contato');
    }

    public function testeEditar()
    {
        $contato = new Contato('Joao', 'Rua Z', '11', '22', '33');
        $contato->salvar();
        $resposta = $this->get(URL_RAIZ . 'contatos/' . $contato->getId() . '/editar');
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
        $resposta = $this->get(URL_RAIZ . 'contatos/' . $contato->getId());
        $this->verificarContem($resposta, 'Mostrando Contato');
        $this->verificarContem($resposta, $contato->getNome());
        $this->verificarContem($resposta, $contato->getEndereco());
        $this->verificarContem($resposta, $contato->getTelefone1());
        $this->verificarContem($resposta, $contato->getTelefone2());
        $this->verificarContem($resposta, $contato->getTelefone3());
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'contatos', [
            'nome' => 'Mario',
            'endereco' => 'Rua A',
            'telefone1' => '11',
            'telefone2' => '22',
            'telefone3' => '33',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'contatos');
        $resposta = $this->get(URL_RAIZ . 'contatos');
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
        $resposta = $this->patch(URL_RAIZ . 'contatos/' . $contato->getId(), [
            'nome' => 'Mario',
            'endereco' => 'Rua A',
            'telefone1' => '44',
            'telefone2' => '55',
            'telefone3' => '66',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'contatos');
        $resposta = $this->get(URL_RAIZ . 'contatos');
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
        $resposta = $this->delete(URL_RAIZ . 'contatos/' . $contato->getId());
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'contatos');
        $resposta = $this->get(URL_RAIZ . 'contatos');
        $this->verificarNaoContem($resposta, 'Joao');
    }
}
