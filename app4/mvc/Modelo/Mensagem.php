<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Mensagem extends Modelo
{
    const BUSCAR_TODOS = 'SELECT m.texto, m.id m_id, u.id u_id, u.email FROM mensagens m JOIN usuarios u ON (m.usuario_id = u.id) ORDER BY m.id LIMIT ? OFFSET ?';
    const BUSCAR_ID = 'SELECT * FROM mensagens WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO mensagens(usuario_id,texto) VALUES (?, ?)';
    const DELETAR = 'DELETE FROM mensagens WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM mensagens';
    private $id;
    private $usuarioId;
    private $texto;
    private $usuario;

    public function __construct(
        $usuarioId,
        $texto,
        $usuario = null,
        $id = null
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->texto = $texto;
        $this->usuario = $usuario;
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

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->texto, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Mensagem(
                $registro['usuario_id'],
                $registro['texto'],
                null,
                $registro['id']
            );
        }
        return $objeto;
    }

    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['email'],
                '',
                null,
                $registro['u_id']
            );
            $objetos[] = new Mensagem(
                $registro['u_id'],
                $registro['texto'],
                $usuario,
                $registro['m_id']
            );
        }
        return $objetos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if (strlen($this->texto) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }
    }
}
