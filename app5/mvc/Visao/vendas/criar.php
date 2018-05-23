<?php if ($sucesso) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $sucesso ?>
    </div>
<?php endif ?>

<form action="<?= URL_RAIZ . 'vendas' ?>" method="post" class="margin-bottom">
    <div class="form-group <?= $this->getErroCss('produtoId') ?>">
        <label class="control-label" for="produtoId">Produto *</label>
        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'produtoId']) ?>
        <select id="produtoId" name="produtoId" class="form-control" autofocus>
            <?php foreach ($produtos as $produto) : ?>
                <?php $selected = $this->getPost('produtoId') == $produto->getId() ? 'selected' : '' ?>
                <option value="<?= $produto->getId() ?>" <?= $selected ?>><?= $produto->getNome() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group <?= $this->getErroCss('quantidade') ?>">
        <label class="control-label" for="quantidade">Quantidade *</label>
        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'quantidade']) ?>
        <input id="quantidade" name="quantidade" class="form-control" value="<?= $this->getPost('quantidade') ?>">
    </div>
    <div class="form-group <?= $this->getErroCss('precoTotal') ?>">
        <label class="control-label" for="precoTotal">Preço total *</label>
        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'precoTotal']) ?>
        <input id="precoTotal" name="precoTotal" class="form-control" value="<?= $this->getPost('precoTotal') ?>">
    </div>
    <button type="submit" class="btn btn-primary center-block">Cadastrar</button>
</form>
