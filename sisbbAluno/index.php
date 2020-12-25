<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Entity\Livro;

session_start();

if (isset($_POST['ativo']) && isset($_POST['busca'])) {
    $livros = Livro::getLivros_2('lv_situacao = "disponivel" and '.$_POST['ativo'], NULL, NULL, '"%'.$_POST['busca'].'%" group by '.$_POST['ativo']);
}

if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header1.php';
    include __DIR__.'/../includes/info_user.php';
    include __DIR__.'/../includes/livros_disponiveis.php';
    include __DIR__.'/../includes/footer.php';
}else{
    header('location: ../index.php?status=errorAcesso');
    exit;
}
