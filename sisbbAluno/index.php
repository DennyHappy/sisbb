<?php

require __DIR__.'/../../vendor/autoload.php';

//use \App\Entity\Livro;

session_start();

if (isset($_POST['ativo']) && isset($_POST['busca'])) {
    
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://localhost:8080/livro?'.$_POST['ativo'].'='.$_POST['busca'].'&situacao=DISPONIVEL',
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
}

//if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header1.php';
    //include __DIR__.'/../includes/info_user.php';
    include __DIR__.'/../includes/livros_disponiveis.php';
    include __DIR__.'/../includes/footer.php';
//}else{
//    header('location: ../index.php?status=errorAcesso');
//    exit;
//}
