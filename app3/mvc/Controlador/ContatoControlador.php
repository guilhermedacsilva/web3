<?php
namespace Controlador;

use \Modelo\Contato;

class ContatoControlador extends Controlador
{
    public function index()
    {
        $contatos = Contato::buscarTodos();
        $this->visao('contatos/index.php', [
            'contatos' => $contatos
        ]);
    }

    public function mostrar($id)
    {
        $contato = Contato::buscarId($id);
        $this->visao('contatos/mostrar.php', [
            'contato' => $contato
        ]);
    }

    public function criar()
    {
        $this->visao('contatos/criar.php');
    }

    public function armazenar()
    {
        $contato = new Contato($_POST['nome'],
            $_POST['endereco'],
            $_POST['telefone1'],
            $_POST['telefone2'],
            $_POST['telefone3']
        );
        $contato->salvar();
        $this->redirecionar(URL_RAIZ . 'contatos');
    }

    public function editar($id)
    {
        $contato = Contato::buscarId($id);
        $this->visao('contatos/editar.php', [
            'contato' => $contato
        ]);
    }

    public function atualizar($id)
    {
        $contato = Contato::buscarId($id);
        $contato->setNome($_POST['nome']);
        $contato->setEndereco($_POST['endereco']);
        $contato->setTelefone1($_POST['telefone1']);
        $contato->setTelefone2($_POST['telefone2']);
        $contato->setTelefone3($_POST['telefone3']);
        $contato->salvar();
        $this->redirecionar(URL_RAIZ . 'contatos');
    }

    public function destruir($id)
    {
        Contato::destruir($id);
        $this->redirecionar(URL_RAIZ . 'contatos');
    }
}
