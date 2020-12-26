<?php

require __DIR__.'/../vendor/autoload.php';

use \App\Entity\Livro;

session_start();

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=errorEditarLvr');
    exit;
}

//CONSULTA LIVRO
$obLivro = Livro::getLivro($_GET['id']);

//echo "<pre>"; print_r($obLivro); echo "</pre>"; exit;

//VALIDAÇÃO DO LIVRO
if (!$obLivro instanceof Livro) {
    header('location: index.php?status=errorEditarLvr');
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

        //echo "<pre>"; print_r($obLivro); echo "</pre>"; exit;

    }
    
    
    header('location: ver_livros.php?situacao='.$_POST['lv_situacao'].'&status=successEditarLvr');
    exit;

}

if (isset($_SESSION['email'])) {
    include __DIR__.'/../includes/header.php';
    include __DIR__.'/../includes/info_user_adm.php';
    include __DIR__.'/../includes/alterar_livro.php';
    include __DIR__.'/../includes/footer.php';
}else{
    header('location: ../index.php?status=errorAcesso');
    exit;
}
