<?php

require __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Reserva;
//use \App\Entity\Itens_Reserva;
//use \App\Entity\Livro;

session_start();

$param = $_GET['hora'];

//CONSULTA RESERVA
//$obReserva = Reserva::getReserva($_POST['rsv_codigo']);

//echo "<pre>"; print_r($obReserva); echo "</pre>"; exit;

//if ($obReserva instanceof Reserva) {
    //VALIDAÇÃO DO POST
    if (isset($_POST[$param],$_POST['data'],$_POST['cod'])) {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://localhost:8080/reserva/reagendar/'.$_POST['rsv_codigo'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'PUT',
          CURLOPT_POSTFIELDS =>'{
            "dataReserva": "'.$_POST['data'].'",
            "horaReserva": "'.$_POST[$param].':00'.'",
            "codigoAgenda": '.$_POST['cod'].'
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;

        header('location: ver_minhas_reservas.php?mtcl='.$_SESSION['mtcl'].'&status=successReagendaRsv');
        exit;
    }else{
        header('location: ver_horarios.php?status=errorReagendaRsv');
        exit;
    }
//}else{
    //header('location: ver_horarios.php?status=errorReagendaRsv');
    //exit;
//}
