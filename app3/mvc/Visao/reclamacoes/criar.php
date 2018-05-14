<div class="center-block site">
    <h1 class="text-center">Cadastro de Reclamação</h1>
    <nav class="text-center">
        <form action="<?= URL_RAIZ . 'login' ?>" method="post" class="inline">
            <input type="hidden" name="_metodo" value="DELETE">
            <a href="" class="btn btn-default" onclick="event.preventDefault(); this.parentNode.submit()">
                Sair do sistema
            </a>
        </form>
    </nav>

    <?php if ($mensagem) : ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= $mensagem ?>
        </div>
    <?php endif ?>
    
    <form action="<?= URL_RAIZ . 'reclamacoes' ?>" method="post">
        <div class="form-group">
            <label class="control-label" for="usuario">Usuário</label>
            <input id="usuario" class="form-control" value="<?= $usuario->getNome() ?>" disabled>
        </div>
        <div class="form-group">
            <label class="control-label" for="dataIncidente">Data do incidente</label>
            <input id="dataIncidente" name="dataIncidente" class="form-control" autofocus type="date">
        </div>
        <div class="form-group">
            <label class="control-label" for="local">Local</label>
            <input id="local" name="local" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label" for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary center-block">Cadastrar a reclamação</button>
    </form>
</div>
