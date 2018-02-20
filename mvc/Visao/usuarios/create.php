<div class="center-block site">
    <div class="col-sm-6 col-sm-offset-3">
        <h1 class="text-center">Cadastre-se no Chat!</h1>
        <form action="<?= URL_RAIZ . 'usuarios' ?>" method="post" class="margin-bottom" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input id="email" name="email" class="form-control" autofocus>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input id="senha" name="senha" class="form-control" type="password">
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input id="foto" name="foto" class="form-control" type="file">
            </div>
            <button type="submit" class="btn btn-primary center-block">Cadastrar-se</button>
        </form>
        <p class="text-center">
            <a href="<?= URL_RAIZ . 'login' ?>">Voltar para a tela de Login</a>
        </p>
    </div>
</div>
