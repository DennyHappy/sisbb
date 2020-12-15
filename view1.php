<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Livro;

session_start();

//echo "<pre>"; print_r($_POST['ativo']); echo "</pre>"; exit;

if (isset($_POST['ativo']) && isset($_POST['busca'])) {
    $livros = Livro::getLivros($_POST['ativo'], NULL, NULL, '"%'.$_POST['busca'].'%"');
}



//echo "<pre>"; print_r($livros); echo "</pre>"; exit;

include __DIR__.'/includes/header1.php';
include __DIR__.'/includes/info_user.php';
include __DIR__.'/includes/livros_disponiveis.php';
include __DIR__.'/includes/footer.php';

