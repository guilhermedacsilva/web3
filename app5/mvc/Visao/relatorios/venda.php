<form method="get" class="margin-bottom">
	<div class="form-group">
        <label class="control-label" for="produtoId">Produto</label>
        <select id="produtoId" name="produtoId" class="form-control" autofocus>
        	<option value="">---</option>
            <?php foreach ($produtos as $produto) : ?>
                <?php $selected = $this->getGet('produtoId') == $produto->getId() ? 'selected' : '' ?>
                <option value="<?= $produto->getId() ?>" <?= $selected ?>><?= $produto->getNome() ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label class="control-label" for="quantidadeMin">Quantidade</label>
        <br>
        <input id="quantidadeMin" name="quantidadeMin" class="form-control campo-metade" value="<?= $this->getGet('quantidadeMin') ?>" placeholder="Mínima">
        <input id="quantidadeMax" name="quantidadeMax" class="form-control campo-metade" value="<?= $this->getGet('quantidadeMax') ?>" placeholder="Máxima">
    </div>
    <div class="form-group">
        <label class="control-label" for="precoTotalMin">Preço total</label>
        <br>
        <input id="precoTotalMin" name="precoTotalMin" class="form-control campo-metade" value="<?= $this->getGet('precoTotalMin') ?>" placeholder="Mínimo">
        <input id="precoTotalMax" name="precoTotalMax" class="form-control campo-metade" value="<?= $this->getGet('precoTotalMax') ?>" placeholder="Máximo">
    </div>
    <button type="submit" class="btn btn-primary center-block largura100">Filtrar</button>
</form>

<hr>

<table class="table table-condensed table-bordered">
	<tr class="active">
		<th>Produto</th>
		<th>Quantidade</th>
		<th>Preço Total</th>
	</tr>
	<?php for ($i = 0; $i < count($registros)-1; $i++) : ?>
		<tr>
			<td><?= $registros[$i]['produto'] ?></td>
			<td class="text-right"><?= $registros[$i]['quantidade'] ?></td>
			<td class="text-right"><?= number_format($registros[$i]['preco_total'], 2, ',', '.') ?></td>
		</tr>
	<?php endfor ?>
	<tr class="active negrito">
		<td>TOTAL</td>
		<td class="text-right"><?= $registros[$i]['quantidade'] ?></td>
		<td class="text-right"><?= number_format($registros[$i]['preco_total'], 2, ',', '.') ?></td>
	</tr>
</table>