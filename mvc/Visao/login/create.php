<!DOCTYPE html>
<html>
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'geral.css' ?>">
</head>
<body>
    <div class="center-block site">
        <div class="col-sm-6 col-sm-offset-3">
            <h1 class="text-center">Login</h1>
            <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="margin-bottom">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input id="email" name="email" class="form-control" autofocus>
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input id="senha" name="senha" class="form-control" type="password">
                </div>
                <button type="submit" class="btn btn-default center-block">Entrar</button>
            </form>
            <p class="text-center">
                <a href="<?= URL_RAIZ . 'usuarios/create' ?>">Não tem um usuário? Cadastrar-se aqui!</a>
            </p>
        </div>
    </div>
</body>
</html>
