<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
	public function testeInserir()
	{
        $usuario = new Usuario('email-teste', 'senha', null);
        $usuario->salvar();
        $query = DW3BancoDeDados::getPdo()->query("SELECT * FROM usuarios WHERE email = 'email2-teste'");
        $bdUsuairo = $query->fetch();
        $this->verificar($bdUsuairo !== false);
	}
}
