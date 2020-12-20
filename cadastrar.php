<?php

require __DIR__.'/vendor/autoload.php';

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

define('TITLE','Cadastrar Agenda');

use \App\Entity\Agenda;

session_start();

//VALIDAÇÃO DO POST
if (isset($_POST['agd_data'],$_POST['agd_hora_ini'],$_POST['agd_hora_fin'])) {
    $obAgenda = new Agenda;
    $obAgenda->agd_data = $_POST['agd_data'];
    $obAgenda->agd_hora_ini = $_POST['agd_hora_ini'];
    $obAgenda->agd_hora_fin = $_POST['agd_hora_fin'];
    $obAgenda->cadastrar();

    header('location: view2.php?status=successCadastro');
    exit;
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/info_user_adm.php';
include __DIR__.'/includes/formulario_agenda.php';
include __DIR__.'/includes/footer.php';

