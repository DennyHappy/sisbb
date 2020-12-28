<?php
require_once '../config.php';

try {
  //DEFINIÇÃOES DA API DE AUTENTICAÇÃO DO GOOGLE
  $adapter->authenticate();
  $userProfile = $adapter->getUserProfile();

  $_SESSION['nome'] = $userProfile->displayName;
  $_SESSION['email'] = $userProfile->email;
  $_SESSION['identifier'] = $userProfile->identifier;

  if (isset($_POST['matricula'],$_POST['nome'],$_POST['email'],$_POST['identifier'])) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:8080/usuariocm/',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "matricula": '.$_POST['matricula'].',
        "nome": "'.$_POST['nome'].'",
        "email": "'.$_POST['email'].'",
        "idUser": '.$_POST['identifier'].'
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    //echo $response;

    header('location: index.php?status=successCadastro');
    exit;
    
  }else{
    echo 'Preencha os campos!';
  }
  
}catch( Exception $e ){
    echo $e->getMessage() ;
}


if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header2.php';
    include __DIR__.'/../includes/formulario_cadastro.php';
    include __DIR__.'/../includes/footer.php';
}else{
    header('location: ../index.php?status=errorAcesso');
    exit;
}