<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Reserva;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: view2.php?status=error');
    exit;
}

//CONSULTA RESERVAS
$obReservas = Reserva::getReservas('rsv_codigo_agenda='.$_GET['id'], null, null);

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/info_user_adm.php';
include __DIR__.'/includes/listagem_de_reservas.php';
include __DIR__.'/includes/footer.php';

