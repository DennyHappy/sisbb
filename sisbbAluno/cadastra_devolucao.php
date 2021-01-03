<?php

require __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Reserva;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['codRsv']) or !is_numeric($_GET['codRsv'])){
    header('location: ver_minhas_reservas.php?id='.$_GET['mtcl'].'&status=errorCadastraDvlc');
    exit;
}