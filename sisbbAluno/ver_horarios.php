<?php

require __DIR__.'/../../vendor/autoload.php';

//use \App\Entity\Agenda;

//session_start();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/agenda/',
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

$agendas = json_decode($response);

//$agendas = Agenda::getAgendas();

//if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header1.php';
//    include __DIR__.'/../includes/info_user.php';
    include __DIR__.'/../includes/listagem_horarios.php';
    include __DIR__.'/../includes/footer.php';
//}else{
//    header('location: ../index.php?status=errorAcesso');
//    exit;
//}

