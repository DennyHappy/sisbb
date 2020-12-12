<?php

require __DIR__.'/vendor/autoload.php';

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

use \App\Entity\Reserva;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA RESERVA
$obReserva = Reserva::getReserva($_GET['id']);

//VALIDAÇÃO DA RESERVA
if (!$obReserva instanceof Reserva) {
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
//valida se os dados chegaram corretamente
if(isset($_POST['rsv_status_reserva']) && isset($_POST['rsv_codigo'])){

    $obReserva->rsv_status_reserva = $_POST['rsv_status_reserva'];
    $obReserva->atualizar();
    
    header('location: ver_reservas.php?id='.$_POST['rsv_codigo'].'&?status=success');
    exit;

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/alterar_reserva.php';
include __DIR__.'/includes/footer.php';

