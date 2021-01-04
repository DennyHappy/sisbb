<?php

    $mensagem = '';
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'successCadastroRsv':
                $mensagem = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong>Reserva cadastrada com sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
            
            case 'successReagendaRsv':
                $mensagem = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                <strong>Reserva Reagendada com sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
            case 'errorCadastraDvlc':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas ao Reservar Devolução!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
        }
    }

    $resultados = '';
    if (isset($obReservas->content)) {
        
        foreach ($obReservas->content as $reserva) {
            if ($reserva->matricula == $_SESSION['mtcl']) {
                
                $resultados .= '<tr>
                                    <td class="text-center">'.$reserva->codigo.'</td>
                                    <td class="text-center">'.$reserva->tipoReserva.'</td>
                                    <td class="text-center">'.date('d/m/Y', strtotime($reserva->dataReserva)).'</td>
                                    <td class="text-center">'.$reserva->horaReserva.'</td>
                                    <td class="text-center">'.$reserva->matricula.'</td>
                                    <td class="text-center">'.($reserva->statusReserva == 'ATIVA' ? '<span class=" btn btn-warning btn-sm">Ativa</span>' : '<span class="btn btn-success btn-sm">Concluida</span>').'</td>
                                    <td class="text-center">
                                        <a class="btn btn-secondary btn-sm" href="../sisbbBibliotecario/ver_itens.php?id='.$reserva->codigo.'">
                                            Ver itens
                                        </a>
                                        ';
                                        $dataRsv = $reserva->dataReserva;
                                        $dataAtl = date('Y-m-d');
                                        
                                        //echo 'Rsv'.$dataRsv.'Atl'.$dataAtl;
                                        if ($dataRsv < $dataAtl) {
                                            $resultados .= '
                                            <a class="btn btn-danger btn-sm" href="ver_horarios.php?codRsv='.$reserva->codigo.'">
                                                Reagendar
                                            </a>
                                            ';
                                        }
                                        if ($reserva->statusReserva == 'CONCLUIDA' && $reserva->tipoReserva == 'RETIRADA') {
                                            $resultados .= '
                                            <a class="btn btn-info btn-sm" href="ver_horarios.php?codRsvPD='.$reserva->codigo.'">
                                                Reservar Devolução
                                            </a>
                                            ';
                                        }
            }
                                    
            $resultados .= '
                                </td>
                            </tr>';
        }
        # code...
    }else{
        $resultados .= '
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-warning text-center" role="alert">
                                    <h5>Nenhuma reserva no momento!</h5>
                                </div>
                            </td>
                        </tr>';
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

    <h2 class="mt-3 text-secondary">Minhas Reservas</h2>

    <section style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
        <table class="table bg-white mt-4">
            <thead>
                <tr>
                    <th class="text-center">COD.</th>
                    <th class="text-center">TIPO DA RESERVA</th>
                    <th class="text-center">DATA DA RESERVA</th>
                    <th class="text-center">HORA DA RESERVA</th>
                    <th class="text-center">SUA MATRICULA</th>
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