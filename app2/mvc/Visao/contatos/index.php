<div class="center-block site">
    <h1 class="text-center">Agenda de Contatos</h1>
    <nav>
        <a href="<?= URL_RAIZ . 'contatos/criar' ?>" class="btn btn-primary">Cadastrar contato</a>
    </nav>
    <table class="table">
        <tr>
            <th>Ações</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone 1</th>
            <th>Telefone 2</th>
            <th>Telefone 3</th>
        </tr>
        <?php if (empty($contatos)) : ?>
            <tr>
                <td colspan="99" class="text-center">Nenhum contato encontrado.</td>
            </tr>
        <?php endif ?>
        <?php foreach ($contatos as $contato) : ?>
            <tr>
                <td>
                    <a href="<?= URL_RAIZ . 'contatos/' . $contato->getId() ?>" class="btn btn-default btn-xs" title="Mostrar">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>

                    <a href="<?= URL_RAIZ . 'contatos/' . $contato->getId() . '/editar' ?>" class="btn btn-primary btn-xs" title="Editar">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <form action="<?= URL_RAIZ . 'contatos/' . $contato->getId() ?>" method="post" class="inline">
                        <input type="hidden" name="_metodo" value="DELETE">
                        <a href="" class="btn btn-danger btn-xs" title="Deletar" onclick="event.preventDefault(); this.parentNode.submit()">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </form>
                </td>
                <td><?= $contato->getNome() ?></td>
                <td><?= $contato->getEndereco() ?></td>
                <td><?= $contato->getTelefone1() ?></td>
                <td><?= $contato->getTelefone2() ?></td>
                <td><?= $contato->getTelefone3() ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
