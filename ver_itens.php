<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Itens_Reserva;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: ver_reservas.php?id='.$_GET['id'].'?status=error');
    exit;
}

//CONSULTA RESERVAS
$obItensReservas = Itens_Reserva::getItensReservas('it_rsv_cod_reserva='.$_GET['id']);

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/listagem_de_itens.php';
include __DIR__.'/includes/footer.php';

