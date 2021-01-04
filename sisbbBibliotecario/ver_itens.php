<?php

require __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Itens_Reserva;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: ver_reservas.php?id='.$_GET['id'].'?status=error');
    exit;
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/reserva/'.$_GET['id'],
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

$obItensReservas = json_decode($response);
//CONSULTA RESERVAS
//$obItensReservas = Itens_Reserva::getItensReservas('it_rsv_cod_reserva='.$_GET['id']);

//if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header2.php';
//    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/listagem_de_itens.php';
    include __DIR__.'/../includes/footer.php';
//}else{
//    header('location: ../index.php?status=errorAcesso');
//    exit;
//}

