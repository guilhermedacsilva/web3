<?php
namespace Framework;

class DW3ImagemUpload
{
    const TIPOS_PERMITIDOS = [
        IMAGETYPE_JPEG,
        // IMAGETYPE_PNG,
        // IMAGETYPE_GIF,
    ];

    const ARQUIVO_NOME = 'tmp_name';
    const TAMANHO = 'size';
    const KILOBYTE = 1024;
    const TAMANHO_MAXIMO = 500 * self::KILOBYTE;

    // verifica se foi feito o upload
    public static function existeUpload($arquivoUpload)
    {
        return $arquivoUpload != null
            && $arquivoUpload[self::TAMANHO] > 0;
    }

    // verifica se tudo é valido
    public static function isValida($arquivo)
    {
        return self::isArquivoImagem($arquivo)
            && $arquivo[self::TAMANHO] <= self::TAMANHO_MAXIMO;
    }

    private static function isArquivoImagem($arquivoUpload)
    {
        /* verifica se é uma imagem
           pode ocorrer falso positivo */
        return self::existeUpload($arquivoUpload)
            && getimagesize($arquivoUpload[self::ARQUIVO_NOME]);
    }

    private static function isTipoPermitido($arquivoUpload)
    {
        $imagemTipo = exif_imagetype($arquivo[self::ARQUIVO_NOME]);
        if (!in_array($imagemTipo, self::TIPOS_PERMITIDOS)) {
            return false;
        }
    }

    public static function salvar($arquivo, $destino)
    {
        move_uploaded_file($arquivo[self::ARQUIVO_NOME], $destino);
    }

    public static function existe($imagemNome)
    {
        return file_exists(PASTA_PUBLICO . "img/$imagemNome");
    }
}
