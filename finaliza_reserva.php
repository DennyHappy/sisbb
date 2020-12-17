<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Reserva;

session_start();

$param = $_GET['hora'];

//CONSULTA RESERVA
$obReserva1 = Reserva::getReserva_2('"'.$_POST['data'].'"','"'.$_POST[$param].':00"');

//echo "<pre>"; print_r($obReserva1); echo "</pre>"; exit;

if ($obReserva1 == NULL) {
    //VALIDAÇÃO DO POST
    if (isset($_POST[$param],$_POST['data'],$_POST['cod'])) {
        $obReserva = new Reserva;
        $obReserva->rsv_data_reserva = $_POST['data'];
        $obReserva->rsv_hora_reserva = $_POST[$param].':00';
        $obReserva->rsv_matricula_userC = $_SESSION['matricula'];
        $obReserva->rsv_codigo_agenda = $_POST['cod'];
        
        //echo "<pre>"; print_r($obReserva); echo "</pre>"; exit;
        $obReserva->cadastrar();

        header('location: ver_minhas_reservas.php?mtc='.$_SESSION['matricula'].'&status=success');
        exit;
    }else{
        header('location: ver_horarios.php?status=error');
        exit;
    }
}else{
    header('location: ver_horarios.php?status=error');
    exit;
}

//if (isset($_POST[$param],$_POST['data'])) {
//    echo "<pre>"; print_r($_SESSION['dados']); echo "</pre>"; exit;
//}