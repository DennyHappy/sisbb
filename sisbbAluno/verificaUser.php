<?php 

require_once '../config.php';

try {
  //DEFINIÇÃOES DA API DE AUTENTICAÇÃO DO GOOGLE
  $adapter->authenticate();
  $userProfile = $adapter->getUserProfile();

  $_SESSION['nome'] = $userProfile->displayName;
  $_SESSION['email'] = $userProfile->email;
  $_SESSION['identifier'] = $userProfile->identifier;

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

  if ($users->content == []) {
  	header('location: cadastrarUser.php');
	exit;
  }else{
  	foreach ($users->content as $user) {
  		if ($user->email == $_SESSION['email']) {
  			//A CONTA GOOGLE É DESCONECTADA
  			$adapter->disconnect();

  			//A SESSÃO INICIADA É LIMPA E DEPOIS DESTRUIDA
  			session_unset();
  			session_destroy();
  			
		  	header('location: ../index.php?status=errorCadastroExistente');
			exit;
  		}
  	}
  }



  

}catch( Exception $e ){
    echo $e->getMessage() ;
}
