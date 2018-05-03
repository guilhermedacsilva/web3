<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Contato;
use \Framework\DW3BancoDeDados;

class TesteContato extends Teste
{
    public function testeArmazenar()
    {
        $contato = new Contato('Pedro', 'Rua X', '11', '22', '33');
        $contato->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM contatos');
        $bdContato = $query->fetch();
        $this->verificar($bdContato['nome'] === $contato->getNome());
    }
    
    public function testeAtualizar()
    {
        $contato = new Contato('Pedro', 'Rua X', '11', '22', '33');
        $contato->salvar();
        $contato->setNome('Rui');
        $contato->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM contatos');
        $bdContato = $query->fetch();
        $this->verificar($bdContato['nome'] === $contato->getNome());
    }
    
    public function testeDestruir()
    {
        $contato = new Contato('Mario');
        $contato->salvar();
        Contato::destruir($contato->getId());
        $query = DW3BancoDeDados::query('SELECT * FROM contatos');
        $registros = $query->fetchAll();
        $this->verificar(count($registros) === 0);
    }

    public function testeBuscarId()
    {
        $contato1 = new Contato('Maria');
        $contato1->salvar();
        $contato2 = Contato::buscarId($contato1->getId());
        $this->verificar($contato1->getNome() == $contato2->getNome());
    }

    public function testeBuscarTodos()
    {
        (new Contato('Maria'))->salvar();
        (new Contato('José'))->salvar();
        $contatos = Contato::buscarTodos();
        $this->verificar(count($contatos) == 2);
    }
}
