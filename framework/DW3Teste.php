<?php
namespace Framework;

abstract class DW3Teste
{
    public function antes() {}

    public function depois() {}

    public function recriarBancoDeDados()
    {
        $arquivos = scandir(PASTA_SQLS);
        $arquivos = array_filter($arquivos, function($arquivo) {
            return substr($arquivo, -4) === '.sql';
        });
        sort($arquivos);
        DW3BancoDeDados::exec('DROP DATABASE ' . DW3BancoDeDados::getBanco());
        foreach ($arquivos as $arquivo) {
            $comandos = file_get_contents(PASTA_SQLS . $arquivo);
            $comandos = explode(";", $comandos);
            foreach ($comandos as $comando) {
                if (trim($comando) != '') {
                    DW3BancoDeDados::exec($comando);
                    DW3BancoDeDados::reconectar();
                }
            }
        }
    }

    protected function verificar($condicao)
    {
        if (!$condicao) {
            throw new DW3VerificarException();
        }
    }

    protected function verificarContem($resposta, $texto)
    {
        if (strpos($resposta['html'], $texto) === false) {
            throw new DW3VerificarException();
        }
    }

    protected function verificarNaoContem($resposta, $texto)
    {
        if (strpos($resposta['html'], $texto) !== false) {
            throw new DW3VerificarException();
        }
    }

    protected function verificarRedirecionar($resposta, $url)
    {
        if ($resposta['redirecionar'] !== $url) {
            throw new DW3VerificarException();
        }
    }

    protected function get($url, $dados = [])
    {
        return $this->requisicao('GET', $url, $dados);
    }

    protected function post($url, $dados = [])
    {
        return $this->requisicao('POST', $url, $dados);
    }

    protected function delete($url, $dados = [])
    {
        return $this->requisicao('DELETE', $url, $dados);
    }

    protected function patch($url, $dados = [])
    {
        return $this->requisicao('PATCH', $url, $dados);
    }

    private function requisicao($metodo, $url, $dados = [])
    {
        ob_start();
        DW3Controlador::modoTeste();
        $_SERVER['REQUEST_URI'] = $url;
        $_SERVER['REQUEST_METHOD'] = $metodo;
        if ($metodo == 'GET') {
            $_GET = $dados;
        } else {
            $_POST = $dados;
        }
        $app = new DW3Aplicacao();
        $app->executar();
        $resposta = [
            'html' => ob_get_contents(),
            'redirecionar' => DW3Controlador::getRedirecionarUrl()
        ];
        ob_end_clean();
        return $resposta;
    }
}
