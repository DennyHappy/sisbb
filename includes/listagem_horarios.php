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
        }
    }

    $resultados = '';
    foreach ($agendas as $agenda) {
        $resultados .= '<div class="card">
                            <form action="finaliza_reserva.php?hora=ativo'.$agenda->agd_codigo.'" method="post">
                            <div class="card-header" id="heading'.$agenda->agd_codigo.'">
                                <div class="row">
                                    <div class="col-9">
                                        <h5 class="mb-0">
                                            <a href="#" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#collapse'.$agenda->agd_codigo.'" aria-expanded="true" aria-controls="collapseOne">
                                                Horários disponíveis para o dia '.date('d/m/Y', strtotime($agenda->agd_data)).'
                                            </a>
                                        </h5>
                                    </div>
                                    <div class="col-3 text-right">
                                        <button type="submit" class="btn btn-success btn-sm">Prosseguir</button>
                                    </div>
                                </div>
                            </div>

                            <div id="collapse'.$agenda->agd_codigo.'" class="collapse" aria-labelledby="heading'.$agenda->agd_codigo.'" data-parent="#accordion">
                                <div class="card-body">
                                <input type="hidden" name="data" value="'.$agenda->agd_data.'">
                                <input type="hidden" name="cod" value="'.$agenda->agd_codigo.'">
                                    <div class="col-8 mx-auto">
                                    <h5>Horários:</h5>';

                                    $hrIni = intval(substr($agenda->agd_hora_ini,0,-6));
                                    $hrFin = intval(substr($agenda->agd_hora_fin,0,-6));
                                    $minIni = intval(substr($agenda->agd_hora_ini,3,-3));
                                    $minFin = intval(substr($agenda->agd_hora_fin,3,-3));

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
                                                                <input type="radio" name="ativo'.$agenda->agd_codigo.'" value="'.$hora.':'.$minuto.'" checked> '.$hora.':'.$minuto.'
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