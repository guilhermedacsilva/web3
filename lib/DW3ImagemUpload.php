<?php
namespace Lib;

const ARQUIVO_NOME = 'tmp_name';
const TAMANHO = 'size';
const KILOBYTE = 1024;

class DW3ImagemUpload
{
    const TIPOS_PERMITIDOS = [
        IMAGETYPE_JPEG,
        // IMAGETYPE_PNG,
        // IMAGETYPE_GIF
    ];

    public static function isValida($arquivo)
    {
        if ($arquivo == null) {
            return false;
        }
        $valida = getimagesize($arquivo[ARQUIVO_NOME]);
        if ($valida === false) {
            return false;
        }
        if ($arquivo[TAMANHO] > 500 * KILOBYTE) {
            return false;
        }
        $tipo = exif_imagetype($arquivo[ARQUIVO_NOME]);
        if (!in_array($tipo, self::TIPOS_PERMITIDOS)) {
            return false;
        }
        return true;
    }

    public static function salvar($arquivo, $destino)
    {
        move_uploaded_file($arquivo[ARQUIVO_NOME], $destino);
    }

    public static function existe($imagemNome)
    {
        return file_exists(PASTA_RAIZ . "Public/img/$imagemNome");
    }
}
