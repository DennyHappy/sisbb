<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Entity\Reserva;
use \App\Entity\Itens_Reserva;
use \App\Entity\Livro;

session_start();

$param = $_GET['hora'];

//CONSULTA RESERVA
$obReserva = Reserva::getReserva($_POST['rsv_codigo']);

//echo "<pre>"; print_r($obReserva); echo "</pre>"; exit;

if ($obReserva instanceof Reserva) {
    //VALIDAÇÃO DO POST
    if (isset($_POST[$param],$_POST['data'],$_POST['cod'])) {
        
        $obReserva->rsv_data_reserva = $_POST['data'];
        $obReserva->rsv_hora_reserva = $_POST[$param].':00';
        $obReserva->rsv_codigo_agenda = $_POST['cod'];
        
        //echo "<pre>"; print_r($obReserva); echo "</pre>"; exit;
        $obReserva->reagenda();

        header('location: ver_minhas_reservas.php?mtc='.$_SESSION['matricula'].'&status=successReagendaRsv');
        exit;
    }else{
        header('location: ver_horarios.php?status=errorReagendaRsv');
        exit;
    }
}else{
    header('location: ver_horarios.php?status=errorReagendaRsv');
    exit;
}
