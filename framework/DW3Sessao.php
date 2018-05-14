<?php
namespace Framework;

class DW3Sessao
{
    const CHAVE_FLASH_USAR = '__flashUsar';
    const CHAVE_FLASH_GUARDAR = '__flashGuardar';

    /* usado nos testes automatizados */
    private static $iniciarSessao = true;

    public static function modoTeste()
    {
        self::$iniciarSessao = false;
        $_SESSION = [];
        $_SESSION[self::CHAVE_FLASH_USAR] = [];
        $_SESSION[self::CHAVE_FLASH_GUARDAR] = [];
    }

    public static function get($chave, $valorPadrao = null)
    {
        if (array_key_exists($chave, $_SESSION)) {
            return $_SESSION[$chave];
        }
        return $valorPadrao;
    }

    public static function set($chave, $valor)
    {
        $_SESSION[$chave] = $valor;
    }

    public static function deletar($chave)
    {
        if (array_key_exists($chave, $_SESSION)) {
            unset($_SESSION[$chave]);
        }
    }

    public static function setFlash($chave, $valor)
    {
        $_SESSION[self::CHAVE_FLASH_GUARDAR][$chave] = $valor;
    }

    public static function getFlash($chave, $valorPadrao = null)
    {
        if (array_key_exists($chave, $_SESSION[self::CHAVE_FLASH_USAR])) {
            return $_SESSION[self::CHAVE_FLASH_USAR][$chave];
        }
        return $valorPadrao;
    }

    public static function iniciar()
    {
        if (self::$iniciarSessao) {
            session_start();
            if (!array_key_exists(self::CHAVE_FLASH_GUARDAR, $_SESSION)) {
                $_SESSION[self::CHAVE_FLASH_GUARDAR] = [];
            }
            if (!array_key_exists(self::CHAVE_FLASH_USAR, $_SESSION)) {
                $_SESSION[self::CHAVE_FLASH_USAR] = [];
            }
        }
        $_SESSION[self::CHAVE_FLASH_USAR] = $_SESSION[self::CHAVE_FLASH_GUARDAR];
        $_SESSION[self::CHAVE_FLASH_GUARDAR] = [];
    }
}
