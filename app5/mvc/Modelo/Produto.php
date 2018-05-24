<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Produto extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM produtos ORDER BY nome';
    const BUSCAR_ID = 'SELECT * FROM produtos WHERE id = ?';
    private $id;
    private $nome;

    public function __construct($id, $nome) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Produto($registro['id'], $registro['nome']);
        }
        return $objetos;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        if ($registro != false) {
            return new Produto($registro['id'], $registro['nome']);
        }
        return null;
    }
}
