<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Mensagem extends Modelo
{
    const BUSCAR_TODOS = 'SELECT id, texto, usuario FROM mensagens ORDER BY id';
    const INSERIR = 'INSERT INTO mensagens(usuario,texto) VALUES (?, ?)';
    private $id;
    private $usuario;
    private $texto;

    public function __construct(
        $usuario,
        $texto,
        $id = null
    ) {
        $this->usuario = $usuario;
        $this->texto = $texto;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function salvar()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuario, PDO::PARAM_STR);
        $comando->bindValue(2, $this->texto, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Mensagem(
                $registro['usuario'],
                $registro['texto'],
                $registro['id']
            );
        }
        return $objetos;
    }
}
