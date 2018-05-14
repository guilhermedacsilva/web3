<?php if ($mensagem) : ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?= $mensagem ?>
    </div>
<?php endif ?>

<h1 class="text-center">Reclamações</h1>
<table class="table">
    <tr>
        <th>Ações</th>
        <th>Data do incidente</th>
        <th>Usuário</th>
        <th>Local</th>
        <th>Descrição</th>
    </tr>
    <?php if (empty($reclamacoes)) : ?>
        <tr>
            <td colspan="99" class="text-center">Nenhuma reclamação encontrada.</td>
        </tr>
    <?php endif ?>
    <?php foreach ($reclamacoes as $reclamacao) : ?>
        <tr>
            <td>
                <form action="<?= URL_RAIZ . 'reclamacoes/' . $reclamacao->getId() ?>" method="post" class="inline">
                    <input type="hidden" name="_metodo" value="PATCH">
                    <a href="" class="btn btn-primary btn-xs" title="Marcar como atendida" onclick="event.preventDefault(); this.parentNode.submit()">
                        <span class="glyphicon glyphicon-ok"></span>
                    </a>
                </form>
            </td>
            <td><?= $reclamacao->getDataIncidenteFormatada() ?></td>
            <td><?= $reclamacao->getUsuario()->getNome() ?></td>
            <td><?= $reclamacao->getLocal() ?></td>
            <td><?= $reclamacao->getDescricao() ?></td>
        </tr>
    <?php endforeach ?>
</table>
