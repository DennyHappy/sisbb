<?php

require __DIR__.'/../../vendor/autoload.php';

use \App\Entity\Reserva;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['mtc'])){
    header('location: '.$_SERVER['HTTP_REFERER'].'?status=error');
    exit;
}

//CONSULTA RESERVAS
$obReservas = Reserva::getReservas('rsv_matricula_userC='.$_GET['mtc'], null, null);

if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header1.php';
    include __DIR__.'/../includes/info_user.php';
    include __DIR__.'/../includes/listagem_minhas_reservas.php';
    include __DIR__.'/../includes/footer.php';
}else{
    header('location: ../index.php?status=errorAcesso');
    exit;
}
