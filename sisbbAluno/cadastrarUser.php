<?php
require_once '../config.php';

try {
  //DEFINIÇÃOES DA API DE AUTENTICAÇÃO DO GOOGLE
  $adapter->authenticate();
  $userProfile = $adapter->getUserProfile();

  $_SESSION['nome'] = $userProfile->displayName;
  $_SESSION['email'] = $userProfile->email;
  $_SESSION['identifier'] = $userProfile->identifier;

  if ($_SESSION['email']) {
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:8080/usuariocm',
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
    
    $users = json_decode($response);

    foreach ($users->content as $user) {
      if ($user->email == $_SESSION['email']) {
        //A CONTA GOOGLE É DESCONECTADA
        $adapter->disconnect();

        //A SESSÃO INICIADA É LIMPA E DEPOIS DESTRUIDA
        session_unset();
        session_destroy();

        header('location: ../index.php?status=errorCadastroExistente');
        exit;
        
      }else{

        if (isset($_POST['matricula'],$_POST['nome'],$_POST['email'],$_POST['idUser'])) {
          
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
              "idUser": '.$_POST['idUser'].'
          }',
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
            ),
          ));

          $response = curl_exec($curl);

          curl_close($curl);
          
          header('location: index.php?status=successCadastroUser');
          $_SESSION['mtcl'] = $_POST['matricula'];
          exit;
        }
      }
    }
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