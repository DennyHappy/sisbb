<?php

require __DIR__.'/../../vendor/autoload.php';

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

define('TITLE','Editar Agenda');

//use \App\Entity\Agenda;

//session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=errorEditar');
    exit;
}

//CONSULTA AGENDA
//$obAgenda = Agenda::getAgenda($_GET['id']);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/agenda/'.$_GET['id'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);

$obAgenda = json_decode($response);

//VALIDAÇÃO A AGENDA
//if (!$obAgenda instanceof Agenda) {
//    header('location: index.php?status=errorEditar');
//    exit;
//}

//VALIDAÇÃO DO POST
if (isset($obAgenda->codigo,$_POST['data'],$_POST['horaIni'],$_POST['horaFin'])) {
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:8080/agenda/'.$obAgenda->codigo,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_POSTFIELDS =>'{
        "data": "'.$_POST['data'].'",
        "horaIni": "'.$_POST['horaIni'].'",
        "horaFin": "'.$_POST['horaFin'].'"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    //echo "<pre>"; print_r($obAgenda); echo "</pre>"; exit;
    header('location: index.php?status=successEditar');
    exit;
}

//if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header.php';
//    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/formulario_agenda.php';
    include __DIR__.'/../includes/footer.php';
//}else{
//    header('location: ../index.php?status=errorAcesso');
//    exit;
//}

