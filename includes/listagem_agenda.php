<?php
    $mensagem = '';
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'successCadastro':
                $mensagem = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong>Agenda cadastrada com sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;

            case 'successExclusao':
                $mensagem = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong>Exclusão feita com sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
            
            case 'successEditar':
                $mensagem = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong>Alteração feita com sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
            
            case 'errorCadastro':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas ao cadastrar a agenda!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
            
            case 'errorExclusao':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas para excluir a agenda!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
            
            case 'errorEditar':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas para editar a agenda!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
        }
    }

    $resultados = '';
    foreach ($agendas->content as $agenda) {
        $resultados .= '<tr>
                            <td class="text-center">'.$agenda->codigo.'</td>
                            <td class="text-center">'.date('d/m/Y', strtotime($agenda->data)).'</td>
                            <td class="text-center">'.$agenda->horaIni.'</td>
                            <td class="text-center">'.$agenda->horaFin.'</td>
                            <td class="text-center">
                                <a class="btn btn-warning btn-sm" href="ver_reservas.php?id='.$agenda->codigo.'">
                                    Reservas
                                </a>
                                <a class="btn btn-primary btn-sm" href="editar_agenda.php?id='.$agenda->codigo.'">
                                    Editar
                                </a>
                                <a class="btn btn-danger btn-sm" href="excluir_agenda.php?id='.$agenda->codigo.'">
                                    Excluir
                                </a>
                            </td>
                        </tr>';
    }

?>
<main>
    <?=$mensagem?>
    <section class="text-center">
        <a href="cadastrar.php" class="btn btn-info mb-3">
            Nova Agenda
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
        </a>
        <a href="ver_livros.php?situacao=DISPONIVEL" class="btn btn-primary mb-3">
            Livros Disponiveis
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
            </svg>
        </a>
        <a href="ver_livros.php?situacao=EMPRESTADO" class="btn btn-primary mb-3">
            Livros Emprestados
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-dash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </a>
        <a href="ver_livros.php?situacao=QUARENTENA" class="btn btn-primary mb-3">
            Livros em Quarentena
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                <path fill-rule="evenodd" d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z"/>
            </svg>
        </a>
        
    </section>

    <h2 class="mt-3 text-secondary">Agendas Disponíveis</h2>

    <section style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
        <table class="table table-hover bg-white mt-4">
            <thead>
                <tr>
                    <th class="text-center">COD. AGENDA</th>
                    <th class="text-center">DATA</th>
                    <th class="text-center">HORA DE INICIO</th>
                    <th class="text-center">HORA FINAL</th>
                    <th class="text-center">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>
        </table>
    </section>


</main>