<?php

require __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Reserva;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['mtcl'])){
    header('location: '.$_SERVER['HTTP_REFERER'].'?status=error');
    exit;
}

//CONSULTA RESERVAS
//$obReservas = Reserva::getReservas('rsv_matricula_userC='.$_GET['mtc'], null, null);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/reserva',
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

$obReservas = json_decode($response);

if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header1.php';
    include __DIR__.'/../includes/info_user.php';
    include __DIR__.'/../includes/listagem_minhas_reservas.php';
    include __DIR__.'/../includes/footer.php';
}else{
    header('location: ../index.php?status=errorAcesso');
    exit;
}
