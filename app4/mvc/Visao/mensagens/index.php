<div class="center-block site">
    <h1 class="text-center">Chat Online</h1>
    
    <?php if ($mensagemFlash) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagemFlash ?>
        </div>
    <?php endif ?>
    
    <h2>Escreva a mensagem</h2>
    <div class="margin-bottom">
        <form action="<?= URL_RAIZ . 'mensagens' ?>" method="post" class="form-inline pull-left margin-right">
            <div class="form-group <?= $this->getErroCss('texto') ?>">
                <input id="texto" name="texto" class="form-control campo-grande" autofocus placeholder="Texto" value="<?= $this->getPost('texto') ?>">
            </div>
            <button type="submit" class="btn btn-default">Enviar mensagem</button>
            <?php $this->incluirVisao('util/formErro.php', ['campo' => 'texto']) ?>
        </form>
        <form action="<?= URL_RAIZ . 'login' ?>" method="post">
            <input type="hidden" name="_metodo" value="DELETE">
            <button type="submit" class="btn btn-danger">Sair</button>
        </form>
    </div>

    <h2>Mensagens</h2>
    <?php foreach ($mensagens as $mensagem) : ?>
        <form action="<?= URL_RAIZ . 'mensagens/' . $mensagem->getId() ?>" method="post" class="clearfix margin-bottom">
            <input type="hidden" name="_metodo" value="DELETE">
            <img src="<?= URL_IMG . $mensagem->getUsuario()->getImagem() ?>" alt="Imagem do perfil" class="imagem-usuario pull-left">
            <strong><?= $mensagem->getUsuario()->getEmail() ?>:</strong>
            <?= $mensagem->getTexto() ?>
            <br>
            <button type="submit" class="btn btn-xs btn-danger" title="Deletar">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
        </form>
    <?php endforeach ?>
    <div>
        <?php if ($pagina > 1) : ?>
            <a href="<?= URL_RAIZ . 'mensagens?p=' . ($pagina-1) ?>" class="btn btn-default">Página anterior</a>
        <?php endif ?>
        <?php if ($pagina < $ultimaPagina) : ?>
            <a href="<?= URL_RAIZ . 'mensagens?p=' . ($pagina+1) ?>" class="btn btn-default">Próxima página</a>
        <?php endif ?>
    </div>
</div>
