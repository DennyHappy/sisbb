<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Livro;

session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

//adicona produto

if (isset($_GET['acao'])) {

    //ADICIONAR AO CARRINHO

    if ($_GET['acao'] == 'add') {
        $id = intval($_GET['id']);
        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = 1;
        }else{
            $_SESSION['carrinho'][$id] += 1;
        }
    }

    //REMOVER CARRINHO
    if ($_GET['acao'] == 'del') {
        $id = intval($_GET['id']);
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
        if (!empty($_SESSION['dados'][0])) {
            unset($_SESSION['dados'][0]);
        }
    }
}

//print_r($_SESSION['carrinho']);
//echo "<pre>"; print_r($_SESSION['carrinho']); echo "</pre>"; exit;

if (count($_SESSION['carrinho']) == 0) {
    $resultados = ' <tr>
                        <td colspan="4">
                            <div class="alert alert-warning" role="alert">
                                <h5>Não há livros no carrinho!</h5>
                            </div>
                        </td>
                    </tr>';
}else{

    $_SESSION['dados'] = [];

    $resultados = '';
    foreach ($_SESSION['carrinho'] as $id => $qtd) {
        $obLivro = Livro::getLivro($id);
    
        $resultados .= '
                        <tr>
                            <td>'.$obLivro->lv_cod_barras.'</td>
                            <td>'.$obLivro->lv_titulo.'</td>
                            <td><a href="?acao=del&id='.$id.'" class="btn btn-primary btn-sm">Remover</a></td>
                        </tr>
        ';

        array_push($_SESSION['dados'],[
            'lv_cod_barras' => $obLivro->lv_cod_barras
        ]);
    }
}


include __DIR__.'/includes/header1.php';
include __DIR__.'/includes/info_user.php';
include __DIR__.'/includes/carrinho.php';
include __DIR__.'/includes/footer.php';