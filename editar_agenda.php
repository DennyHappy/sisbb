<?php

require __DIR__.'/vendor/autoload.php';

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

define('TITLE','Editar Agenda');

use \App\Entity\Agenda;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: view2.php?status=errorEditar');
    exit;
}

//CONSULTA AGENDA
$obAgenda = Agenda::getAgenda($_GET['id']);

//VALIDAÇÃO A AGENDA
if (!$obAgenda instanceof Agenda) {
    header('location: view2.php?status=errorEditar');
    exit;
}

//VALIDAÇÃO DO POST
if (isset($_POST['agd_data'],$_POST['agd_hora_ini'],$_POST['agd_hora_fin'])) {
    
    $obAgenda->agd_data = $_POST['agd_data'];
    $obAgenda->agd_hora_ini = $_POST['agd_hora_ini'];
    $obAgenda->agd_hora_fin = $_POST['agd_hora_fin'];
    
    $obAgenda->atualizar();

    //echo "<pre>"; print_r($obAgenda); echo "</pre>"; exit;
    header('location: view2.php?status=successEditar');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/info_user_adm.php';
include __DIR__.'/includes/formulario_agenda.php';
include __DIR__.'/includes/footer.php';

