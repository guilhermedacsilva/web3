<?php
namespace Controller;

class RaizController
{
    public function index()
    {
        header('Location: ' . URL_RAIZ . 'login');
        exit;
    }
}
