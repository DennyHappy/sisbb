<?php

require __DIR__.'/../../vendor/autoload.php';

//use \App\Entity\Livro;

//session_start();

//VALIDAÇÃO DA SITUAÇÃO
if(!isset($_GET['situacao'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA LIVROS DISPONIVEIS
if ($_GET['situacao'] == 'DISPONIVEL') {
    define('TITLE','Livros Disponíveis');
    //$livros = Livro::getLivros('lv_situacao = '.'"'.$_GET['situacao'].'"');
}elseif ($_GET['situacao'] == 'EMPRESTADO') {
    define('TITLE','Livros Emprestados');
    //$livros = Livro::getLivros('lv_situacao = '.'"'.$_GET['situacao'].'"', 'item_reserva,reserva', 'lv_cod_barras = it_rsv_cod_barra_livro and it_rsv_cod_reserva = rsv_codigo');
}elseif ($_GET['situacao'] == 'QUARENTENA') {
    define('TITLE','Livros em Quarentena');
    //$livros = Livro::getLivros('lv_situacao = '.'"'.$_GET['situacao'].'"');
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8080/livro?situacao='.$_GET['situacao'],
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

$livros = json_decode($response);

//echo "<pre>"; print_r($livros); echo "</pre>"; exit;

//if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header.php';
//    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/listagem_livros.php';
    include __DIR__.'/../includes/footer.php';
//}else{
//    header('location: ../index.php?status=errorAcesso');
//    exit;
//}
