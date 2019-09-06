<?php

const APLICACAO_NOME = 'Chat Online';

// Se a URL_RAIZ mudar, verifique arquivo .htaccess
const URL_RAIZ = '/web3/app4/';

// Os caminhos sempre devem terminar com '/'

define('PASTA_RAIZ', dirname(__DIR__) . '/');

const PASTA_CFG = PASTA_RAIZ . 'cfg/';

const PASTA_FRAMEWORK = PASTA_RAIZ . '../framework/';

const PASTA_MVC = PASTA_RAIZ . 'mvc/';
const PASTA_CONTROLADOR = PASTA_MVC . 'Controlador/';
const PASTA_MODELO = PASTA_MVC . 'Modelo/';
const PASTA_VISAO = PASTA_MVC . 'Visao/';

const PASTA_SQLS = PASTA_RAIZ . 'sqls/';

const PASTA_PUBLICO = PASTA_RAIZ . 'publico/';

const PASTA_TESTE = PASTA_RAIZ . 'teste/';

const URL_PUBLICO = URL_RAIZ . 'publico/';
const URL_CSS = URL_PUBLICO . 'css/';
const URL_FONTS = URL_PUBLICO . 'fonts/';
const URL_IMG = URL_PUBLICO . 'img/';
const URL_JS = URL_PUBLICO . 'js/';
