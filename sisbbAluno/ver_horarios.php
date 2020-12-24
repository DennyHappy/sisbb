<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Entity\Agenda;

session_start();

$agendas = Agenda::getAgendas();

if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header1.php';
    include __DIR__.'/../includes/info_user.php';
    include __DIR__.'/../includes/listagem_horarios.php';
    include __DIR__.'/../includes/footer.php';
}else{
    header('location: ../index.php?status=errorAcesso');
    exit;
}

