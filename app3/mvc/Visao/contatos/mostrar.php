<div class="center-block site">
    <h1 class="text-center">Mostrando Contato</h1>
    <nav>
        <a href="<?= URL_RAIZ . 'contatos' ?>" class="btn btn-default">Voltar para a listagem</a>
    </nav>
    <form>
        <div class="form-group">
            <label class="control-label" for="nome">Nome *</label>
            <input id="nome" name="nome" class="form-control" disabled="disabled" value="<?= $contato->getNome() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="endereco">Endereço</label>
            <input id="endereco" name="endereco" class="form-control" disabled="disabled" value="<?= $contato->getEndereco() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="telefone1">Telefone 1</label>
            <input id="telefone1" name="telefone1" class="form-control" disabled="disabled" value="<?= $contato->getTelefone1() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="telefone2">Telefone 2</label>
            <input id="telefone2" name="telefone2" class="form-control" disabled="disabled" value="<?= $contato->getTelefone2() ?>">
        </div>
        <div class="form-group">
            <label class="control-label" for="telefone3">Telefone 3</label>
            <input id="telefone3" name="telefone3" class="form-control" disabled="disabled" value="<?= $contato->getTelefone3() ?>">
        </div>
    </form>
</div>
