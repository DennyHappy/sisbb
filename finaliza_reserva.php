<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Reserva;
use \App\Entity\Itens_Reserva;
use \App\Entity\Livro;

session_start();

$param = $_GET['hora'];

//CONSULTA RESERVA
$obReserva1 = Reserva::getReserva_2('"'.$_POST['data'].'"','"'.$_POST[$param].':00"');

//echo "<pre>"; print_r($obReserva1); echo "</pre>"; exit;

if ($obReserva1 == NULL) {
    //VALIDAÇÃO DO POST
    if (isset($_POST[$param],$_POST['data'],$_POST['cod'])) {
        $obReserva = new Reserva;
        $obReserva->rsv_data_reserva = $_POST['data'];
        $obReserva->rsv_hora_reserva = $_POST[$param].':00';
        $obReserva->rsv_matricula_userC = $_SESSION['matricula'];
        $obReserva->rsv_codigo_agenda = $_POST['cod'];
        
        //echo "<pre>"; print_r($obReserva); echo "</pre>"; exit;
        $obReserva->cadastrar();
        $codReserva = $obReserva->rsv_codigo;
        //echo "<pre>"; print_r($codLivro); echo "</pre>"; exit;

        if (isset($codReserva,$_SESSION['dados'])) {
            foreach ($_SESSION['dados'] as $cod_livro) {
                $obItReserva = new Itens_Reserva;
                $obItReserva->it_rsv_cod_reserva = $codReserva;
                $obItReserva->it_rsv_cod_barra_livro = $cod_livro['lv_cod_barras'];

                //echo "<pre>"; print_r($obItReserva); echo "</pre>"; exit;
                $obItReserva->cadastrar();

                //CONSULTA LIVRO
                $obLivro = Livro::getLivro($cod_livro['lv_cod_barras']);

                //echo "<pre>"; print_r($obLivro); echo "</pre>"; exit;

                //VALIDAÇÃO DO LIVRO
                if ($obLivro instanceof Livro) {
                    $obLivro->lv_situacao = 'emprestado';
                    $obLivro->atualizar_situacao();
                }

                /*if (isset($_SESSION['carrinho'],$_SESSION['dados'])) {

                    $cont = count($_SESSION['dados']);
                    //echo "<pre>"; print_r($cont); echo "</pre>"; exit;
                    for ($i=0; $i < $cont; $i++) { 
                        unset($_SESSION['carrinho']['lv_cod_barras']);
                        unset($_SESSION['dados'][$i]);
                    }
                }*/

                $_SESSION['carrinho'] = [];
                $_SESSION['dados'] = [];
                
            }

        }

        header('location: ver_minhas_reservas.php?mtc='.$_SESSION['matricula'].'&status=successCadastroRsv');
        exit;
    }else{
        header('location: ver_horarios.php?status=errorCadastroRsv');
        exit;
    }
}else{
    header('location: ver_horarios.php?status=errorCadastroRsv');
    exit;
}

//if (isset($_POST[$param],$_POST['data'])) {
//    echo "<pre>"; print_r($_SESSION['dados']); echo "</pre>"; exit;
//}