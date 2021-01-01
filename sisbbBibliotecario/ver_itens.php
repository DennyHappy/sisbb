<?php

require __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Itens_Reserva;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: ver_reservas.php?id='.$_GET['id'].'?status=error');
    exit;
}

//CONSULTA RESERVAS
$obItensReservas = Itens_Reserva::getItensReservas('it_rsv_cod_reserva='.$_GET['id']);

if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header.php';
    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/listagem_de_itens.php';
    include __DIR__.'/../includes/footer.php';
}else{
    header('location: ../index.php?status=errorAcesso');
    exit;
}

