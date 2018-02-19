<?php
namespace Framework;

class Sessao
{
    public static function get($chave, $valorPadrao = null)
    {
        self::iniciar();
        if (array_key_exists($chave, $_SESSION)) {
            return $_SESSION[$chave];
        }
        return $valorPadrao;
    }

    public static function set($chave, $valor)
    {
        self::iniciar();
        $_SESSION[$chave] = $valor;
    }

    public static function deletar($chave)
    {
        self::iniciar();
        if (array_key_exists($chave, $_SESSION)) {
            unset($_SESSION[$chave]);
        }
    }

    private static function iniciar()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
