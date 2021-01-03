<?php
    $mensagem = '';
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            
            case 'successEditarRsv':
                $mensagem = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong>Alteração feita com sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
            
            case 'errorEditarRsv':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas ao editar a reserva!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
        }
    }

    $resultados = '';
    foreach ($obReservas->content as $reserva) {
        if ($reserva->codigoAgenda == $_GET['id']) {
            
            $resultados .= '<tr>
                                <td class="text-center">'.$reserva->codigo.'</td>
                                <td class="text-center">'.$reserva->tipoReserva.'</td>
                                <td class="text-center">'.date('d/m/Y', strtotime($reserva->dataReserva)).'</td>
                                <td class="text-center">'.$reserva->horaReserva.'</td>
                                <td class="text-center">'.$reserva->matricula.'</td>
                                <td class="text-center">'.($reserva->statusReserva == 'ATIVA' ? '<span class=" btn btn-warning btn-sm">Ativa</span>' : '<span class="btn btn-success btn-sm">Concluida</span>').'</td>
                                <td class="text-center">
                                    <a class="btn btn-secondary btn-sm" href="ver_itens.php?id='.$reserva->codigo.'">
                                        Ver itens
                                    </a>
                                    <a class="btn btn-primary btn-sm" href="editar_reserva.php?id='.$reserva->codigo.'&cdag='.$reserva->codigoAgenda.'">
                                        Editar
                                    </a>
                                </td>
                            </tr>';
        }
    }

?>
<main>
<?=$mensagem?>

    <section>
        <a href="index.php" class="btn btn-primary">
            Voltar
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-return-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </a>
    </section>

    <h2 class="mt-3 text-secondary">Reservas da Agenda</h2>

    <section style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
        <table class="table bg-white mt-4">
            <thead>
                <tr>
                    <th class="text-center">COD.</th>
                    <th class="text-center">TIPO DA RESERVA</th>
                    <th class="text-center">DATA DA RESERVA</th>
                    <th class="text-center">HORA DA RESERVA</th>
                    <th class="text-center">MATRICULA ALUNO</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>
        </table>
    </section>


</main>