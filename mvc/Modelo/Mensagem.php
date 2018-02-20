<?php
namespace Modelo;

use \PDO;
use \Lib\DW3BancoDeDados;

class Mensagem extends Modelo
{
    const BUSCAR_TODOS = 'SELECT m.texto, u.id, u.email FROM mensagens m JOIN usuarios u ON (m.usuario_id = u.id) ORDER BY m.id';
    const INSERIR = 'INSERT INTO mensagens(usuario_id,texto) VALUES (?, ?)';
    private $usuarioId;
    private $texto;
    private $usuario;

    public function __construct(
        $usuarioId,
        $texto,
        $usuario = null
    ) {
        $this->usuarioId = $usuarioId;
        $this->texto = $texto;
        $this->usuario = $usuario;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function save()
    {
        $this->inserir();
    }

    private function inserir()
    {
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindParam(1, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindParam(2, $this->texto, PDO::PARAM_STR, 255);
        $comando->execute();
    }

    public static function all()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                $registro['email'],
                '',
                null,
                $registro['id']
            );
            $objetos[] = new Mensagem(
                $registro['id'],
                $registro['texto'],
                $usuario
            );
        }
        return $objetos;
    }

    protected function verificarErros()
    {
        if (strlen($this->texto) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }
    }
}
