<?php

    $mensagem = '';
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            
            case 'errorCadastroRsv':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas ao cadastrar a reserva! <br>Horário já ocupado! <br>Escolha outro horário!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;

            case 'errorReagendaRsv':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas ao reagendar a reserva! <br>Horário já ocupado! <br>Escolha outro horário!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;

            case 'errorCadastraDvlc':
                $mensagem = '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                <strong>Problemas ao cadastrar a devolução! <br>Horário já ocupado! <br>Escolha outro horário!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                break;
        }
    }

    $resultados = '';
    foreach ($agendas->content as $agenda) {
        $resultados .= '<div class="card">';
                        if (isset($_GET['codRsv'])) {
                            $resultados .= '<form action="reagendar.php?hora=ativo'.$agenda->codigo.'" method="post">
                                                <input type="hidden" name="codigo" value="'.$_GET['codRsv'].'">
                                            ';
                        }elseif(isset($_GET['codRsvPD'])){
                            $resultados .= '<form action="cadastra_devolucao.php?hora=ativo'.$agenda->codigo.'&codRsvPD='.$_GET['codRsvPD'].'" method="post">
                                            
                                            ';
                        }else{
                            $resultados .= '<form action="finaliza_reserva.php?hora=ativo'.$agenda->codigo.'" method="post">';
                        }

        $resultados .= '
                            <div class="card-header" id="heading'.$agenda->codigo.'">
                                <div class="row">
                                    <div class="col-9">
                                        <h5 class="mb-0">
                                            <a href="#" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#collapse'.$agenda->codigo.'" aria-expanded="true" aria-controls="collapseOne">
                                                Horários disponíveis para o dia '.date('d/m/Y', strtotime($agenda->data)).'
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="col-3 text-right">
                                        <button type="submit" class="btn btn-success btn-sm">Prosseguir</button>
                                    </div>
                                </div>
                            </div>

                            <div id="collapse'.$agenda->codigo.'" class="collapse" aria-labelledby="heading'.$agenda->codigo.'" data-parent="#accordion">
                                <div class="card-body">
                                <input type="hidden" name="data" value="'.$agenda->data.'">
                                <input type="hidden" name="cod" value="'.$agenda->codigo.'">
                                    <div class="col-8 mx-auto">
                                    <h5>Horários:</h5>';

                                    $hrIni = intval(substr($agenda->horaIni,0,-6));
                                    $hrFin = intval(substr($agenda->horaFin,0,-6));
                                    $minIni = intval(substr($agenda->horaIni,3,-3));
                                    $minFin = intval(substr($agenda->horaFin,3,-3));

                                    $minIni += $hrIni * 60;
                                    $minFin += $hrFin * 60;

                                    for($i = $minIni; $i <= $minFin; $i += 10) {
                                        if(intval($i/60) < 10) {
                                            $hora = '0'.intval($i/60);
                                        } else {
                                            $hora = intval($i/60);
                                        }
                                        if(intval($i%60) < 10) {
                                            $minuto = '0'.$i%60;
                                        } else {
                                            $minuto = $i%60;
                                        }
                                        $resultados .= '
                                                        <div class="form-check form-check-inline">
                                                            <label class="form-control">
                                                                <input type="radio" name="ativo'.$agenda->codigo.'" value="'.$hora.':'.$minuto.'" checked> '.$hora.':'.$minuto.'
                                                            </label>
                                                        </div>';
                                    }

        $resultados .=  '           </div> 
                                </div>
                            </div>
                            </form>
                        </div>';
    }

?>
<main>
    <?=$mensagem?>  

    <h2 class="mt-3 text-secondary">Dias Disponíveis</h2>
    <hr>
    <section> <!--style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">-->
        <div id="accordion">
            <?=$resultados?>
        </div>
    </section>


</main>