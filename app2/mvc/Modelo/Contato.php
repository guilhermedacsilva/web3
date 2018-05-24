<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Contato extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM contatos ORDER BY nome';
    const BUSCAR_ID = 'SELECT * FROM contatos WHERE id = ?';
    const INSERIR = 'INSERT INTO contatos(nome, endereco, telefone1, telefone2, telefone3) VALUES (?, ?, ?, ?, ?)';
    const ATUALIZAR = 'UPDATE contatos SET nome = ?, endereco = ?, telefone1 = ?, telefone2 = ?, telefone3 = ? WHERE id = ?';
    const DELETAR = 'DELETE FROM contatos WHERE id = ?';
    private $id;
    private $nome;
    private $endereco;
    private $telefone1;
    private $telefone2;
    private $telefone3;

    public function __construct(
        $nome = null,
        $endereco = null,
        $telefone1 = null,
        $telefone2 = null,
        $telefone3 = null,
        $id = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->telefone1 = $telefone1;
        $this->telefone2 = $telefone2;
        $this->telefone3 = $telefone3;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getTelefone1()
    {
        return $this->telefone1;
    }

    public function getTelefone2()
    {
        return $this->telefone2;
    }

    public function getTelefone3()
    {
        return $this->telefone3;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;
    }

    public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

    public function setTelefone3($telefone3)
    {
        $this->telefone3 = $telefone3;
    }

    public function salvar()
    {
        if ($this->id == null) {
            $this->inserir();
        } else {
            $this->atualizar();
        }
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->endereco, PDO::PARAM_STR);
        $comando->bindValue(3, $this->telefone1, PDO::PARAM_STR);
        $comando->bindValue(4, $this->telefone2, PDO::PARAM_STR);
        $comando->bindValue(5, $this->telefone3, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->endereco, PDO::PARAM_STR);
        $comando->bindValue(3, $this->telefone1, PDO::PARAM_STR);
        $comando->bindValue(4, $this->telefone2, PDO::PARAM_STR);
        $comando->bindValue(5, $this->telefone3, PDO::PARAM_STR);
        $comando->bindValue(6, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Contato(
                $registro['nome'],
                $registro['endereco'],
                $registro['telefone1'],
                $registro['telefone2'],
                $registro['telefone3'],
                $registro['id']
            );
        }
        return $objetos;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Contato(
            $registro['nome'],
            $registro['endereco'],
            $registro['telefone1'],
            $registro['telefone2'],
            $registro['telefone3'],
            $registro['id']
        );
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }
}
