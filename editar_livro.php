<?php

require __DIR__.'/vendor/autoload.php';

//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

use \App\Entity\Livro;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//CONSULTA RESERVA
$obLivro = Livro::getLivro($_GET['id']);

//VALIDAÇÃO DA RESERVA
if (!$obLivro instanceof Livro) {
    header('location: index.php?status=error');
    exit;
}

//VALIDAÇÃO DO POST
//valida se os dados chegaram corretamente
if(isset($_POST['lv_situacao_atual']) && isset($_POST['lv_situacao']) && isset($_POST['lv_cod_barras'])){

    if($_POST['lv_situacao_atual'] == 'emprestado'){

        $obLivro->lv_situacao = $_POST['lv_situacao'];
        $obLivro->lv_data_quarentena = date("Y-m-d");//$_POST['lv_data_quarentena'];
        $obLivro->atualizar();

    }elseif($_POST['lv_situacao_atual'] == 'quarentena'){

        $obLivro->lv_situacao = $_POST['lv_situacao'];
        $obLivro->lv_data_quarentena = NULL;//$_POST['lv_data_quarentena'];
        $obLivro->atualizar();

    }
    
    
    header('location: ver_livros.php?situacao='.$_POST['lv_situacao'].'&?status=success');
    exit;

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/alterar_livro.php';
include __DIR__.'/includes/footer.php';

