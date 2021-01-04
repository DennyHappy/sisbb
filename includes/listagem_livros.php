<?php
    $mensagem = '';
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'successEditarLvr':
                $mensagem = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong>Alteração feita com sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
            
            case 'errorEditarLvr':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas ao editar livro!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
        }
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
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;

    $rsvs = json_decode($response);

    $resultados = '';
    foreach ($livros->content as $livro) {
        if ($_GET['situacao'] == 'EMPRESTADO') {
            foreach ($rsvs->content as $rsv) {
                if (in_array($livro->codBarras, $rsv->codBarras) && $rsv->tipoReserva == 'DEVOLUCAO' && $rsv->statusReserva == 'CONCLUIDA') {
                    $resultados .= '<tr>
                                        <td class="text-center">'.$livro->codBarras.'</td>
                                        <td class="text-center">'.$livro->patrimonio.'</td>
                                        <td class="text-center">'.$livro->localizacao.'</td>

                                        

                                        <td class="text-center">'.$livro->titulo.'</td>
                                        <td class="text-center">'.$livro->autor.'</td>
                                        <td class="text-center">'.$livro->edicao.'</td>
                                        <td class="text-center">'.$livro->ano.'</td>
                                        <td class="text-center">'.$livro->volume.'</td>

                                        

                                        '.(TITLE == 'Livros em Quarentena' ? '
                                        <td class="text-center">'.date('d/m/Y', strtotime($livro->dataQuarentena)).'</td>
                                        ':'').'

                                        '.($livro->situacao == 'QUARENTENA' || $livro->situacao == 'EMPRESTADO' ? '
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="editar_livro.php?id='.$livro->codBarras.'">
                                                Editar
                                            </a>
                                        </td>
                                        ' : '
                                        <td class="text-center">
                                            <span class=" btn btn-secondary btn-sm">S/A</span>
                                        </td>').'

                                    </tr>';
                }
            }
        }else{
            $resultados .= '<tr>
                                <td class="text-center">'.$livro->codBarras.'</td>
                                <td class="text-center">'.$livro->patrimonio.'</td>
                                <td class="text-center">'.$livro->localizacao.'</td>

                                

                                <td class="text-center">'.$livro->titulo.'</td>
                                <td class="text-center">'.$livro->autor.'</td>
                                <td class="text-center">'.$livro->edicao.'</td>
                                <td class="text-center">'.$livro->ano.'</td>
                                <td class="text-center">'.$livro->volume.'</td>

                                

                                '.(TITLE == 'Livros em Quarentena' ? '
                                <td class="text-center">'.date('d/m/Y', strtotime($livro->dataQuarentena)).'</td>
                                ':'').'

                                '.($livro->situacao == 'QUARENTENA' || $livro->situacao == 'EMPRESTADO' ? '
                                <td class="text-center">
                                    <a class="btn btn-primary btn-sm" href="editar_livro.php?id='.$livro->codBarras.'">
                                        Editar
                                    </a>
                                </td>
                                ' : '
                                <td class="text-center">
                                    <span class=" btn btn-secondary btn-sm">S/A</span>
                                </td>').'

                            </tr>';
        }
    }

?>
<main>
    <?=$mensagem?> 

    <section class="text-center">
        <a href="index.php" class="btn btn-primary mb-3">
            Agendas 
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar-week" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
            </svg>
        </a>
        <a href="ver_livros.php?situacao=DISPONIVEL" class="<?=(TITLE == 'Livros Disponíveis' ? 'btn btn-info' : 'btn btn-primary')?> mb-3">
            Livros Disponiveis
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg>
        </a>
        <a href="ver_livros.php?situacao=EMPRESTADO" class="<?=(TITLE == 'Livros Emprestados' ? 'btn btn-info' : 'btn btn-primary')?> mb-3">
            Livros Emprestados
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </a>
        <a href="ver_livros.php?situacao=QUARENTENA" class="<?=(TITLE == 'Livros em Quarentena' ? 'btn btn-info' : 'btn btn-primary')?> mb-3">
            Livros em Quarentena
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z"/>
            </svg>
        </a>
        
    </section>

    <h2 class="mt-3 text-secondary"><?=TITLE?></h2>

    <section class="mb-3" style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
        <div>
            <table class="table table-hover bg-white mt-4">
                <thead>
                    <tr>
                        <th class="text-center">COD. LIVRO</th>
                        <th class="text-center">PATRIÔNIO</th>
                        <th class="text-center">LOCALIZAÇÃO</th>
                        
                        <th class="text-center">TITULO</th>
                        <th class="text-center">AUTOR</th>
                        <th class="text-center">EDIÇÃO</th>
                        <th class="text-center">ANO</th>
                        <th class="text-center">VOLUME</th>
                        
                        <?=(TITLE == 'Livros em Quarentena' ? '<th class="text-center">DATA QUARENTENA</th>' : '')?>
                        <th class="text-center">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultados?>
                </tbody>
            </table>
        </div>
    </section>


</main>