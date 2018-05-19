<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
    public function testeArmazenar()
    {
        $contato = new Usuario('Julio', '123');
        $contato->salvar();
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE nome = "Julio"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }

    public function testeBuscarId()
    {
        $contato1 = new Usuario('Maria', '123');
        $contato1->salvar();
        $contato2 = Usuario::buscarId($contato1->getId());
        $this->verificar($contato1->getNome() == $contato2->getNome());
    }

    public function testeBuscarNome()
    {
        (new Usuario('Maria', '123'))->salvar();
        $contato = Usuario::buscarNome('Maria');
        $this->verificar($contato != null);
    }
}
