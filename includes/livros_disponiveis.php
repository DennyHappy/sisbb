<?php

    $resultados = '';
    if (isset($livros)) {
        foreach ($livros as $livro) {
            $resultados .= '<div class="col mb-3">
                                <div class="card h-100">
                                    <div class="text-center mt-3 mb-3">
                                        <font size="7">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-book-half" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8.5 2.687v9.746c.935-.53 2.12-.603 3.213-.493 1.18.12 2.37.461 3.287.811V2.828c-.885-.37-2.154-.769-3.388-.893-1.33-.134-2.458.063-3.112.752zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                            </svg>
                                        </font>
                                    </div>
                                    
                                    <div class="card-body">
                                        <i class="fs-6">Titulo</i>
                                        <h5 class="card-title text-center">'.$livro->lv_titulo.'</h5>
                                        <i class="fs-6">Autor: </i><p class="card-text">'.$livro->lv_autor.'</p>
                                        <i class="fs-6">Edição: </i><p class="card-text">'.$livro->lv_edicao.'</p>
                                        <i class="fs-6">Ano: </i><p class="card-text">'.$livro->lv_ano.'</p>
                                        <i class="fs-6">Volume: </i><p class="card-text">'.$livro->lv_volume.'</p>
                                        <a href="add_carrinho.php?acao=add&id='.$livro->lv_cod_barras.'" class="btn btn-primary btn-sm">
                                        Add a reserva
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Cod. Barras: '.$livro->lv_cod_barras.'</small>
                                    </div>
                                </div>
                            </div>';
        }
    }else{
        $resultados .= '<div class="alert alert-warning" role="alert">
                            <h5>Nenhuma busca feita no momento!</h5>
                        </div>';
    }
    
?>

<main>
    <h2 class="mt-3 text-secondary">Campo de busca</h2>
    <hr>
    <form method="post">
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Pesquisar por: </span>
            </div>
            <div class="input-group-append">
                <div class="input-group-text">
                <INPUT TYPE="radio" NAME="ativo" VALUE="lv_titulo" CHECKED> Titulo
                </div>
            </div>
            <div class="input-group-append">
                <div class="input-group-text">
                <INPUT TYPE="radio" NAME="ativo" VALUE="lv_autor"> Autor
                </div>
            </div>
        </div>
    
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Digite sua busca:</span>
            </div>
            
            <input type="text" class="form-control" name="busca">
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary btn-sm col-3">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
                Buscar
            </button>
        </div>
            
    </form>
    
    <h2 class="mt-3 text-secondary">Livros Disponíveis</h2>
    
    <hr>

    <section> <!--style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">-->
        <?=(isset($livros) ? '<div class="row row-cols-1 row-cols-md-4">' : '<div class="col-12 text-center">')?>
            <?=$resultados?>
        </div>
    </section>


</main>