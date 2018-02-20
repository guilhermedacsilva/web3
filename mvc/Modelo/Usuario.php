<?php
namespace Modelo;

use \PDO;
use \Lib\DW3BancoDeDados;
use \Lib\DW3ImagemUpload;

class Usuario
{
    const BUSCAR_TODOS = 'SELECT * FROM usuarios ORDER BY email';
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(email,senha) VALUES (?, ?)';
    private $id;
    private $email;
    private $senha;
    private $foto;

    public function __construct(
        $email,
        $senha,
        $foto,
        $id = -1
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->foto = $foto;
        $this->setSenha($senha);
    }

    public function getEmail()
    {
        return $this->email;
    }

    private function setSenha($senhaPlana)
    {
        $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImagem()
    {
        $imagemNome = "{$this->id}.jpg";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = "padrao.jpg";
        }
        return $imagemNome;
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    public function save()
    {
        $this->inserir();
        $this->salvarImagem();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindParam(1, $this->email, PDO::PARAM_STR, 255);
        $comando->bindParam(2, $this->senha, PDO::PARAM_STR, 60);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.jpg";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    public static function all()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Usuario(
                $registro['nome'],
                $registro['descricao'],
                $registro['id'],
                $registro['votos']
            );
        }
        return $objetos;
    }

    public static function findEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindParam(1, $email, PDO::PARAM_STR, 255);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['email'],
                '',
                null,
                $registro['id']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }
}
