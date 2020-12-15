<?php

require __DIR__.'/vendor/autoload.php';

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

define('TITLE','Editar Agenda');

use \App\Entity\Agenda;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA AGENDA
$obAgenda = Agenda::getAgenda($_GET['id']);

//VALIDAÇÃO A AGENDA
if (!$obAgenda instanceof Agenda) {
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['agd_data'],$_POST['agd_hora_ini'],$_POST['agd_hora_fin'])) {
    
    $obAgenda->agd_data = $_POST['agd_data'];
    $obAgenda->agd_hora_ini = $_POST['agd_hora_ini'];
    $obAgenda->agd_hora_fin = $_POST['agd_hora_fin'];
    
    $obAgenda->atualizar();

    //echo "<pre>"; print_r($obAgenda); echo "</pre>"; exit;
    header('location: index.php?status=success');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario_agenda.php';
include __DIR__.'/includes/footer.php';
