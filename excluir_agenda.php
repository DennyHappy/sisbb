<?php

include __DIR__.'/vendor/autoload.php';

use \App\Entity\Agenda;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: view2.php?status=errorExclusao');
    exit;
}

//CONSULTA A AGENDA
$obAgenda = Agenda::getAgenda($_GET['id']);

//VALIDAÇÃO DA AGENDA
if(!$obAgenda instanceof Agenda){
    header('location: view2.php?status=errorExclusao');
    exit;
}

//VALIDAÇÃO DO POST
//valida se os dados chegaram corretamente
if(isset($_POST['excluir'])){

    $obAgenda->excluir();
    
    header('Location: view2.php?status=successExclusao');
    exit;

}

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/confirmar_exclusao_agenda.php';
include __DIR__.'/includes/footer.php';

