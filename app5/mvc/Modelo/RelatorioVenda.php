<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class RelatorioVenda
{
    const BUSCAR_TODOS = 'SELECT p.nome as produto, v.quantidade, v.preco_total FROM vendas v JOIN produtos p ON (p.id = v.produto_id) WHERE TRUE';

    public static function buscarRegistros($filtro = [])
    {
        $sqlWhere = '';
        $parametros = [];
        if (array_key_exists('produtoId', $filtro) && $filtro['produtoId'] != '') {
            $parametros[] = $filtro['produtoId'];
            $sqlWhere .= ' AND p.id = ?';
        }
        if (array_key_exists('quantidadeMin', $filtro) && $filtro['quantidadeMin'] != '') {
            $parametros[] = $filtro['quantidadeMin'];
            $sqlWhere .= ' AND v.quantidade >= ?';
        }
        if (array_key_exists('quantidadeMax', $filtro) && $filtro['quantidadeMax'] != '') {
            $parametros[] = $filtro['quantidadeMax'];
            $sqlWhere .= ' AND v.quantidade <= ?';
        }
        if (array_key_exists('precoTotalMin', $filtro) && $filtro['precoTotalMin'] != '') {
            $parametros[] = $filtro['precoTotalMin'];
            $sqlWhere .= ' AND v.preco_total >= ?';
        }
        if (array_key_exists('precoTotalMax', $filtro) && $filtro['precoTotalMax'] != '') {
            $parametros[] = $filtro['precoTotalMax'];
            $sqlWhere .= ' AND v.preco_total <= ?';
        }
        $sql = self::BUSCAR_TODOS . $sqlWhere . ' ORDER BY p.nome';
        $comando = DW3BancoDeDados::prepare($sql);
        foreach ($parametros as $i => $parametro) {
            $comando->bindValue($i+1, $parametro, PDO::PARAM_STR);
        }
        $comando->execute();
        $registros = $comando->fetchAll();
        $totalPreco = 0;
        $totalQuantidade = 0;
        foreach ($registros as $registro) {
            $totalQuantidade += $registro['quantidade'];
            $totalPreco += $registro['preco_total'];
        }
        $registros[] = [
            'quantidade' => $totalQuantidade,
            'preco_total' => $totalPreco
        ];
        return $registros;
    }
}
