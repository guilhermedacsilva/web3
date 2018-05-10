<!DOCTYPE html>
<html>
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'geral.css' ?>">
    <script src="<?= URL_JS . 'jquery-3.1.1.min.js' ?>"></script>
    <script src="<?= URL_JS . 'bootstrap.min.js' ?>"></script>
</head>
<body>

<div class="center-block site">

	<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Navegação</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Reclame UTFPR</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="#">Reclamações</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#" onclick="$('#logout').submit()">Sair</a>
					<form id="logout" action="<?= URL_RAIZ . 'login' ?>" method="post" class="hidden">
						<input type="hidden" name="_metodo" value="DELETE">
					</form>
				</li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

	<?php $this->imprimirConteudo() ?>

</div>

</body>
</html>
