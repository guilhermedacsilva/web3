<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Reclamacao extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM reclamacoes WHERE id = ?';
    const BUSCAR_NAO_ATENDIDOS = 'SELECT * FROM reclamacoes WHERE data_atendimento IS NULL ORDER BY id';
    const INSERIR = 'INSERT INTO reclamacoes(data_incidente, local, descricao, usuario_id) VALUES (?, ?, ?, ?)';
    const ATUALIZAR = 'UPDATE reclamacoes SET data_atendimento = ? WHERE id = ?';
    private $id;
    private $dataIncidente;
    private $local;
    private $descricao;
    private $usuarioId;
    private $usuario;
    private $dataAtendimento;

    public function __construct(
        $dataIncidente = null,
        $local = null,
        $descricao = null,
        $usuarioId = null,
        $id = null,
        $dataAtendimento = null
    ) {
        $this->setDataIncidente($dataIncidente);
        $this->local = $local;
        $this->descricao = $descricao;
        $this->usuarioId = $usuarioId;
        $this->id = $id;
        $this->dataAtendimento = $dataAtendimento;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDataIncidente()
    {
        return $this->dataIncidente;
    }

    public function getDataIncidenteFormatada()
    {
        $data = date_create($this->dataIncidente);
        return date_format($data, 'd/m/Y');
        //$data = new \DateTime($this->dataIncidente);
        //return $data->format('d/m/Y');
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getUsuario()
    {
        if ($this->usuario == null) {
            $this->usuario = Usuario::buscarId($this->usuarioId);
        }
        return $this->usuario;
    }

    public function setDataIncidente($dataIncidente)
    {
        $isBrasileiro = preg_match('/(\d\d)\/(\d\d)\/(\d\d\d\d)/', $dataIncidente, $matches);
        if ($isBrasileiro) {
            $dataIncidente = "$matches[3]-$matches[2]-$matches[1]";
        }
        $this->dataIncidente = $dataIncidente;
    }

    public function setDataAtendimento()
    {
        $this->dataAtendimento = date('Y-m-d h:i:s');
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
        $comando->bindValue(1, $this->dataIncidente, PDO::PARAM_STR);
        $comando->bindValue(2, $this->local, PDO::PARAM_STR);
        $comando->bindValue(3, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(4, $this->usuarioId, PDO::PARAM_INT);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->dataAtendimento, PDO::PARAM_STR);
        $comando->bindValue(2, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Reclamacao(
            $registro['data_incidente'],
            $registro['local'],
            $registro['descricao'],
            $registro['usuario_id'],
            $registro['id'],
            $registro['data_atendimento']
        );
    }

    public static function buscarNaoAtendidos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_NAO_ATENDIDOS);
        $reclamacoes = [];
        foreach ($registros as $registro) {
            $reclamacoes[] = new Reclamacao(
                $registro['data_incidente'],
                $registro['local'],
                $registro['descricao'],
                $registro['usuario_id'],
                $registro['id']
            );
        }
        return $reclamacoes;
    }
}
