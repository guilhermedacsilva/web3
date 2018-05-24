<?php
namespace Framework;

use \PDO;

class DW3BancoDeDados
{
    /*
    Exemplo: mysql:host=localhost;port=3306;dbname=meubanco
    */
    const DNS_FORMATO = '%s:host=%s;port=%s;dbname=%s';
    private static $pdo;
    private static $banco;

    public static function query($sql)
    {
        return self::getPdo()->query($sql);
    }

    public static function exec($sql)
    {
        return self::getPdo()->exec($sql);
    }

    public static function prepare($sql)
    {
        return self::getPdo()->prepare($sql);
    }

    public static function getBanco()
    {
        if (self::$banco == null) {
            self::getPdo();
        }
        return self::$banco;
    }

    public static function getPdo()
    {
        if (self::$pdo == null) {
            self::criarPdo();
        }
        return self::$pdo;
    }

    private static function criarPdo()
    {
        require PASTA_CFG . 'banco.php';
        self::$pdo = new PDO(
            self::getDnsString($banco),
            $banco['usuario'],
            $banco['senha'],
            [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        self::$banco = $banco['banco'];
    }

    private static function getDnsString($banco)
    {
        return sprintf(
            self::DNS_FORMATO,
            $banco['driver'],
            $banco['servidor'],
            $banco['porta'],
            $banco['banco']
        );
    }

    public static function reconectar()
    {
        self::$pdo = null;
        self::criarPdo();
    }
}
