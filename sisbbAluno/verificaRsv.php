<?php 

  $param = $_GET['hora'];

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
  
  $reservas = json_decode($response);

  if ($reservas->content == []) {
  	header('location: finaliza_reserva.php');
	exit;
  }else{
  	foreach ($reservas->content as $rsv) {
  		if ($reservas-> == $_SESSION['email']) {
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

