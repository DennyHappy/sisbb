<?php

require __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Reserva;

session_start();

$param = $_GET['hora'];

//VALIDAÇÃO DO ID
if(!isset($_GET['codRsvPD'])){
    header('location: ver_minhas_reservas.php?mtcl='.$_SESSION['mtcl'].'&status=errorCadastraDvlc');
    exit;
}

//CONSULTA RESERVAS
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

//echo "<pre>"; print_r($reservas->codBarras); echo "</pre>"; exit;

//CADASTRAR NOVA RESERVA DE TIPO "DEVOLUÇÃO"
//NELA, ADICIONAR NOVA DATA
//NOVO HORARIO
//E O CODIGO DOS LIVROS QUE ESTÃO PARA SEREM DEVOLVIDOS



if ($reservas->content == []) {
    
}else{
    if (isset($_GET['codRsvPD'])) {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8080/reserva/'.$_GET['codRsvPD'],
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

      echo "<pre>"; print_r($obReserva); echo "</pre>";
    }

    foreach ($reservas->content as $rsv) {
        if ($rsv->dataReserva == '"'.$_POST['data'].'"' && $rsv->horaReserva == '"'.$_POST[$param].':00"') {
            header('location: ver_horarios.php?status=errorCadastroRsv');
            exit;
        }else{
            $cods = [];

            for ($i=0; $i < count($obReserva->codBarras); $i++) { 
              array_push($cods,$obReserva->codBarras[$i]);
            }
            echo "<pre>"; print_r($cods); echo "</pre>"; 
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://localhost:8080/reserva',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
                "tipoReserva": "DEVOLUCAO",
                "dataReserva": "'.$_POST['data'].'",
                "horaReserva": "'.$_POST[$param].':00",
                "matricula": '.$_SESSION['mtcl'].',
                "nomeUsuario": "'.$_SESSION['nome'].'",
                "codigoAgenda": '.$_POST['cod'].',
                "codBarras": ['.implode(",", $cods).']
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $obReserva2 = json_decode($response);

            echo "<pre>"; print_r($obReserva2); echo "</pre>"; exit;

          header('location: ver_minhas_reservas.php?mtcl='.$_SESSION['mtcl'].'&status=successCadastroRsv');
          exit;
        }
    }
}