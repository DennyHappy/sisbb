<?php

include __DIR__.'/vendor/autoload.php';

use \App\Entity\Agenda;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA A AGENDA
$obAgenda = Agenda::getAgenda($_GET['id']);

//VALIDAÇÃO DA AGENDA
if(!$obAgenda instanceof Agenda){
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
//valida se os dados chegaram corretamente
if(isset($_POST['excluir'])){

    $obAgenda->excluir();
    
    header('Location: index.php?status=success');
    exit;

}

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar_exclusao_agenda.php';
include __DIR__.'/includes/footer.php';

