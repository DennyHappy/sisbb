<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Entity\Livro;

session_start();

//VALIDAÇÃO DA SITUAÇÃO
if(!isset($_GET['situacao'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA LIVROS DISPONIVEIS
if ($_GET['situacao'] == 'disponivel') {
    define('TITLE','Livros Disponíveis');
    $livros = Livro::getLivros('lv_situacao = '.'"'.$_GET['situacao'].'"');
}elseif ($_GET['situacao'] == 'emprestado') {
    define('TITLE','Livros Emprestados');
    $livros = Livro::getLivros('lv_situacao = '.'"'.$_GET['situacao'].'"', 'item_reserva,reserva', 'lv_cod_barras = it_rsv_cod_barra_livro and it_rsv_cod_reserva = rsv_codigo');
}elseif ($_GET['situacao'] == 'quarentena') {
    define('TITLE','Livros em Quarentena');
    $livros = Livro::getLivros('lv_situacao = '.'"'.$_GET['situacao'].'"');
}

//echo "<pre>"; print_r($livros); echo "</pre>"; exit;

if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header.php';
    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/listagem_livros.php';
    include __DIR__.'/../includes/footer.php';
}else{
    header('location: ../index.php?status=errorAcesso');
    exit;
}
