<?php

require __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Reserva;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: ver_reservas.php?id='.$_GET['cdag'].'&status=errorEditarRsv');
    exit;
}

//CONSULTA RESERVA
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
//echo $response;

$obReserva = json_decode($response);

//VALIDAÇÃO DA RESERVA
//if (!$obReserva instanceof Reserva) {
//    header('location: ver_reservas.php?id='.$_GET['id'].'&status=errorEditarRsv');
//    exit;
//}

//VALIDAÇÃO DO POST
//valida se os dados chegaram corretamente
if(isset($_POST['statusReserva']) && isset($_POST['codigo'])){

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:8080/reserva/'.$_GET['id'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_POSTFIELDS =>'{
        "statusReserva": "'.$_POST['statusReserva'].'"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;

    //$obReserva->rsv_status_reserva = $_POST['rsv_status_reserva'];
    //$obReserva->atualizar();
    
    header('location: ver_reservas.php?id='.$_GET['cdag'].'&status=successEditarRsv');
    exit;

}

//if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header.php';
//    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/alterar_reserva.php';
    include __DIR__.'/../includes/footer.php';
//}else{
//    header('location: ../index.php?status=errorAcesso');
//   exit;
//}
