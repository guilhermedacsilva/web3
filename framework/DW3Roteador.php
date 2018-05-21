<?php
namespace Framework;

class DW3Roteador
{
    /* sempre inicia com uma barra
        sempre termina sem uma barra */
    private $raizRelativa;
    private $rotas;
    private $resultado;

    public function __construct()
    {
        $this->rotas = $this->carregarRotas();
        $this->raizRelativa = substr(URL_RAIZ, 0, -1);
    }

    private function carregarRotas()
    {
        require PASTA_CFG . 'rotas.php';
        foreach ($rotas as $chave => $valor) {
            $this->gerarRotaRegex($rotas, $chave);
        }
        return $rotas;
    }

    private function gerarRotaRegex(&$rotas, $chave)
    {
        if (strpos($chave, '?') !== false) {
            $corpoRegex = preg_quote($chave, '/');
            $corpoRegex = str_replace('\?', '([^\/]+)', $corpoRegex);
            $rotas[$chave]['regex'] = "/^$corpoRegex$/";
        }
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    public function interpretarRota()
    {
        // exemplo: /app/login
        $caminhoRequisicao = $this->removerParametrosGet($_SERVER['REQUEST_URI']);

        // exemplo: /login
        $caminhoRota = $this->removerUrlRaiz($caminhoRequisicao);

        // classe DW3Rota
        $this->resultado = $this->recuperarRota($caminhoRota);
    }

    private function removerParametrosGet($caminhoRequisicao)
    {
        $posicao = strpos($caminhoRequisicao, '?');
        if ($posicao !== false) {
            return substr($caminhoRequisicao, 0, $posicao);
        }
        return $caminhoRequisicao;
    }

    private function removerUrlRaiz($caminhoRequisicao)
    {
        return substr($caminhoRequisicao, strlen($this->raizRelativa));
    }

    // exemplo de $caminhoRota: /login
    private function recuperarRota($caminhoRota)
    {
        if ($this->existeRotaEstatica($caminhoRota)) {
            return $this->recuperarRotaEstatica($caminhoRota);
        }

        // exemplo: /produtos/?
        return $this->tentarRecuperarRotaDinamica($caminhoRota);
    }

    private function existeRotaEstatica($caminhoRota)
    {
        return array_key_exists($caminhoRota, $this->rotas);
    }

    private function recuperarRotaEstatica($caminhoRota)
    {
        $rota = $this->rotas[$caminhoRota];

        // exemplo: \Controlador\LoginControlador#criar
        $rotaString = $this->recuperarRotaPorMetodoHttp($rota);

        return $rotaString ? new DW3Rota($rotaString) : false;
    }

    private function tentarRecuperarRotaDinamica($caminhoRota)
    {
        foreach ($this->rotas as $rota) {
            // $resultado é um objeto DW3Rota ou false
            $resultado = $this->tentarAplicarRegex($caminhoRota, $rota);

            if ($resultado) {
                return $resultado;
            }
        }
        return false;
    }

    private function tentarAplicarRegex($caminhoRota, $rota)
    {
        if (array_key_exists('regex', $rota)) {
            preg_match($rota['regex'], $caminhoRota, $resultadoRegexArray);
            if (!empty($resultadoRegexArray)) {
                /* exemplo de resultadoRegexArray:
                [
                    0 => '/produtos/99',
                    1 => 99
                ]
                */
                return $this->recuperarRotaDinamica($resultadoRegexArray, $rota);
            }
        }
        return false;
    }

    private function recuperarRotaDinamica($regexResultado, $rota)
    {
        $rotaString = $this->recuperarRotaPorMetodoHttp($rota);
        if ($rotaString) {
            // remove o primeiro elemento
            array_shift($regexResultado);

            return new DW3Rota($rotaString, $regexResultado);
        }
        return false;
    }

    private function recuperarRotaPorMetodoHttp($rota)
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
