<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Mensagem extends Modelo
{
    const BUSCAR_TODOS = 'SELECT m.texto, m.id m_id, u.id u_id, u.email FROM mensagens m JOIN usuarios u ON (m.usuario_id = u.id) ORDER BY m.id';
    const INSERIR = 'INSERT INTO mensagens(usuario_id,texto) VALUES (?, ?)';
    const DELETAR = 'DELETE FROM mensagens WHERE id = ?';
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

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindParam(1, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindParam(2, $this->texto, PDO::PARAM_STR, 255);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
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

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindParam(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if (strlen($this->texto) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }
    }
}
