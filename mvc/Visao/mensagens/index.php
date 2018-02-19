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
        <h1 class="text-center">Chat Online</h1>
        <h2>Escreva a mensagem</h2>
        <div class="margin-bottom">
            <form action="<?= URL_RAIZ . 'mensagens' ?>" method="post" class="form-inline pull-left margin-right">
                <div class="form-group">
                    <input id="texto" name="texto" class="form-control campo-grande" autofocus placeholder="Texto">
                </div>
                <button type="submit" class="btn btn-default">Enviar mensagem</button>
            </form>
            <form action="<?= URL_RAIZ . 'login' ?>" method="post">
                <input type="hidden" name="_metodo" value="DELETE">
                <button type="submit" class="btn btn-danger">Sair</button>
            </form>
        </div>
        <h2>Mensagens</h2>
        <?php foreach ($mensagens as $mensagem) : ?>
            <p class="clearfix">
                <img src="<?= URL_IMG . $mensagem->getUsuario()->getImagem() ?>" alt="Imagem do perfil" class="imagem-usuario pull-left">
                <strong><?= $mensagem->getUsuario()->getEmail() ?>:</strong>
                <?= $mensagem->getTexto() ?>
            </p>
        <?php endforeach ?>
    </div>
</body>
</html>
