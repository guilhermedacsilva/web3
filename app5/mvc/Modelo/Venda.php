<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Venda extends Modelo
{
    const INSERIR = 'INSERT INTO vendas(produto_id, quantidade, preco_total) VALUES (?, ?, ?)';
    //const BUSCAR_TODOS = 'SELECT * FROM vendas';
    //const CONTAR_TODOS = 'SELECT count(id) FROM mensagens';
    private $id;
    private $produtoId;
    private $quantidade;
    private $precoTotal;

    public function __construct(
        $produtoId,
        $quantidade,
        $precoTotal,
        $id = null
    ) {
        $this->id = $id;
        $this->produtoId = $produtoId;
        $this->quantidade = $quantidade;
        $this->precoTotal = $precoTotal;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProdutoId()
    {
        return $this->produtoId;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function getPrecoTotal()
    {
        return $this->precoTotal;
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->produtoId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->quantidade, PDO::PARAM_INT);
        $comando->bindValue(3, $this->precoTotal, PDO::PARAM_STR, 255);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    protected function verificarErros()
    {
        if ($this->produtoId == null) {
            $this->setErroMensagem('produtoId', 'Selecione um produto.');
        } elseif (Produto::buscarId($this->produtoId) == null) {
            $this->setErroMensagem('produtoId', 'Produto inválido.');
        }
        if ($this->quantidade <= 0) {
            $this->setErroMensagem('quantidade', 'Quantidade inválida.');
        }
        if ($this->precoTotal <= 0) {
            $this->setErroMensagem('precoTotal', 'Preço total inválido.');
        }
    }

    public static function buscarRelatorio()
    {
        
    }

    /*
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
    */
}
