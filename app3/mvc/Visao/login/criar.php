<div class="center-block site">
    <div class="col-sm-6 col-sm-offset-3">
        <h1 class="text-center">Login</h1>
        <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="margin-bottom">
            <div class="form-group">
                <label class="control-label" for="nome">Nome</label>
                <input id="nome" name="nome" class="form-control" autofocus value="<?= $this->getPost('nome') ?>">
            </div>
            <div class="form-group">
                <label class="control-label" for="senha">Senha</label>
                <input id="senha" name="senha" class="form-control" type="password">
            </div>
            <button type="submit" class="btn btn-default center-block">Entrar</button>
        </form>
        <p class="text-center">
            <a href="<?= URL_RAIZ . 'usuarios/criar' ?>">Não tem um usuário? Cadastrar-se aqui!</a>
        </p>
    </div>
</div>
