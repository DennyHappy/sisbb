<?php

require __DIR__.'/../../vendor/autoload.php';

//use \App\Entity\Livro;

//session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=errorEditarLvr');
    exit;
}

//CONSULTA LIVRO

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/livro/'.$_GET['id'],
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

$obLivro = json_decode($response);

//$obLivro = Livro::getLivro($_GET['id']);

//echo "<pre>"; print_r($obLivro); echo "</pre>"; exit;

//VALIDAÇÃO DO LIVRO
//if (!$obLivro instanceof Livro) {
//    header('location: index.php?status=errorEditarLvr');
//    exit;
//}

//VALIDAÇÃO DO POST
//valida se os dados chegaram corretamente
if(isset($_POST['situacao_atual'],$_POST['situacao'])){

    if($_POST['situacao_atual'] == 'EMPRESTADO'){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://localhost:8080/livro/'.$obLivro->codBarras,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'PUT',
          CURLOPT_POSTFIELDS =>'{
            "situacao": "'.$_POST['situacao'].'",
            "dataQuarentena": "'.date("Y-m-d").'"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //echo $response;

        //$obLivro->lv_situacao = $_POST['situacao'];
        //$obLivro->lv_data_quarentena = date("Y-m-d");//$_POST['lv_data_quarentena'];
        //$obLivro->atualizar();

    }elseif($_POST['situacao_atual'] == 'QUARENTENA'){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://localhost:8080/livro/'.$_GET['id'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'PUT',
          CURLOPT_POSTFIELDS =>'{
            "situacao": "'.$_POST['situacao'].'",
            "dataQuarentena": null
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        //$obLivro->lv_situacao = $_POST['lv_situacao'];
        //$obLivro->lv_data_quarentena = NULL;//$_POST['lv_data_quarentena'];
        //$obLivro->atualizar();

        //echo "<pre>"; print_r($obLivro); echo "</pre>"; exit;

    }
    
    
    header('location: ver_livros.php?situacao='.$_POST['situacao'].'&status=successEditarLvr');
    exit;

}

//if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header.php';
//    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/alterar_livro.php';
    include __DIR__.'/../includes/footer.php';
//}else{
//    header('location: ../index.php?status=errorAcesso');
//    exit;
//}
