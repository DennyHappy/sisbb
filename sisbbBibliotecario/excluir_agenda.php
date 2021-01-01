<?php

include __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Agenda;

//session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=errorExclusao');
    exit;
}

//CONSULTA A AGENDA
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


//VERIFICA SE EXISTEM RESERVAS NESSA AGENDA
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

if ($obReservas->content == []) {
    //VALIDAÇÃO DO POST
  //valida se os dados chegaram corretamente
  if(isset($_POST['excluir'])){

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/agenda/'.$_GET['id'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      
      header('Location: index.php?status=successExclusao');
      exit;

  }

}else{
  foreach ($obReservas->content as $rsv) {
    if ($rsv->codigoAgenda == $_GET['id']) {
      header('Location: index.php?status=errorExclusao&idAgd='.$_GET['id']);
      exit;
    }else{
      if(isset($_POST['excluir'])){

          $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:8080/agenda/'.$_GET['id'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
          ));

          $response = curl_exec($curl);

          curl_close($curl);
          
          header('Location: index.php?status=successExclusao');
          exit;

      }
    }
  }
}

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

//if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header.php';
//    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/confirmar_exclusao_agenda.php';
    include __DIR__.'/../includes/footer.php';
//}else{
//    header('location: ../index.php?status=errorAcesso');
//    exit;
//}
