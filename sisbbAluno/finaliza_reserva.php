<?php

require __DIR__.'/../vendor/autoload.php';

//use \App\Entity\Reserva;
//use \App\Entity\Itens_Reserva;
//use \App\Entity\Livro;

session_start();

$param = $_GET['hora'];

//CONSULTA RESERVA

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
    //VALIDAÇÃO DO POST
    if (isset($_POST[$param],$_POST['data'],$_POST['cod'])) {
        $cods = [];

        foreach ($_SESSION['dados'] as $cod_livro) {
          array_push($cods,$cod_livro['codBarras']);
        }

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
            "tipoReserva": "RETIRADA",
            "dataReserva": "'.$_POST['data'].'",
            "horaReserva": "'.$_POST[$param].':00",
            "matricula": '.$_SESSION['mtcl'].',
            "nomeUsuario": "'.$_SESSION['nome'].'",
            "codigoAgenda": '.$_POST['cod'].',
            "codBarras": [],
            "titulos": []
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        //$obReserva = json_decode($response);

        //ADICIONA OS LIVROS A RESERVA
        if (isset($_SESSION['dados'])) {
          
          foreach ($_SESSION['dados'] as $cod_livro) {
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://localhost:8080/livro/'.$cod_livro['codBarras'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'PUT',
              CURLOPT_POSTFIELDS =>'{
                "situacao": "EMPRESTADO",
                "dataQuarentena": null
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //echo $response;
          }
        }

        $_SESSION['carrinho'] = [];
        $_SESSION['dados'] = [];

        header('location: ver_minhas_reservas.php?mtcl='.$_SESSION['mtcl'].'&status=successCadastroRsv');
        exit;
    }else{
        header('location: ver_horarios.php?status=errorCadastroRsv');
        exit;
    }
}else{
    foreach ($reservas->content as $rsv) {
        if ($rsv->dataReserva == '"'.$_POST['data'].'"' && $rsv->horaReserva == '"'.$_POST[$param].':00"') {
            header('location: ver_horarios.php?status=errorCadastroRsv');
            exit;
        }else{
            $cods = [];

            foreach ($_SESSION['dados'] as $cod_livro) {
              array_push($cods,$cod_livro['codBarras']);
            }
            
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
                "tipoReserva": "RETIRADA",
                "dataReserva": "'.$_POST['data'].'",
                "horaReserva": "'.$_POST[$param].':00",
                "matricula": '.$_SESSION['mtcl'].',
                "nomeUsuario": "'.$_SESSION['nome'].'",
                "codigoAgenda": '.$_POST['cod'].',
                "codBarras": ['.implode(",", $cods).'],
                "titulos": []
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            
            //$obReserva = json_decode($response);

            if (isset($_SESSION['dados'])) {
              foreach ($_SESSION['dados'] as $cod_livro) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://localhost:8080/livro/'.$cod_livro['codBarras'],
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'PUT',
                  CURLOPT_POSTFIELDS =>'{
                    "situacao": "EMPRESTADO",
                    "dataQuarentena": null
                }',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                  ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                //echo $response;
              }
            }
          $_SESSION['carrinho'] = [];
          $_SESSION['dados'] = [];

          header('location: ver_minhas_reservas.php?mtcl='.$_SESSION['mtcl'].'&status=successCadastroRsv');
          exit;
        }
    }
}
