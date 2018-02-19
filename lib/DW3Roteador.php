<?php
namespace Lib;

class DW3Roteador
{
    /* sempre inicia com uma barra
        sempre termina sem uma barra */
    private $raizRelativa;
    private $rotas;

    public function __construct()
    {
        $this->rotas = $this->carregarRotas();
        $this->raizRelativa = substr(URL_RAIZ, 0, -1);
    }

    public function interpretarRota()
    {
        $caminhoRequisicao = $_SERVER['REQUEST_URI'];
        $caminhoRota = $this->removerRaizRelativa($caminhoRequisicao);
        return $this->recuperarRota($caminhoRota);
    }

    private function carregarRotas()
    {
        require PASTA_CFG . 'rotas.php';
        foreach ($rotas as $chave => $valor) {
            if (strpos($chave, '?') !== false) {
                $corpoRegex = preg_quote($chave, '/');
                $corpoRegex = str_replace('\?', '([^\/]+)', $corpoRegex);
                $rotas[$chave]['regex'] = "/^$corpoRegex$/";
            }
        }
        return $rotas;
    }

    private function removerRaizRelativa($caminhoRequisicao)
    {
        return substr($caminhoRequisicao, strlen($this->raizRelativa));
    }

    private function recuperarRota($caminhoRota)
    {
        if (array_key_exists($caminhoRota, $this->rotas)) {
            $rota = $this->rotas[$caminhoRota];
            $rotaString = $this->recuperarRotaPorMetodo($rota);
            return $rotaString ? [$rotaString] : false;

        } else {
            foreach ($this->rotas as $rota) {
                $resultado = $this->testarRotaRegex($caminhoRota, $rota);
                if ($resultado) {
                    return $resultado;
                }
            }
        }
        return false;
    }

    private function testarRotaRegex($caminhoRota, $rota)
    {
        if (array_key_exists('regex', $rota)) {
            preg_match($rota['regex'], $caminhoRota, $resultados);
            if (!empty($resultados)) {
                return $this->recuperarRotaComRegex($resultados, $rota);
            }
        }
    }

    private function recuperarRotaComRegex($regexResultado, $rota)
    {
        $rotaString = $this->recuperarRotaPorMetodo($rota);
        if ($rotaString) {
            array_shift($regexResultado);
            if (!empty($regexResultado)) {
                array_push($regexResultado, $rotaString);
                return $regexResultado;
            }
            return [$rotaString];
        }
        return false;
    }

    private function recuperarRotaPorMetodo($rota)
    {
        $requisicaoMetodo = $_SERVER['REQUEST_METHOD'];
        if ($requisicaoMetodo == 'POST'
                && array_key_exists('_metodo', $_POST)) {
                $requisicaoMetodo = $_POST['_metodo'];
        }
        if (array_key_exists($requisicaoMetodo, $rota)) {
            return $rota[$requisicaoMetodo];
        }
        return false;
    }
}
