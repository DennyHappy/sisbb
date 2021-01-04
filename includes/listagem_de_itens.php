<?php

    $resultados = '';
    for ($i=0; $i < count($obItensReservas->codBarras); $i++) { 
        
        $resultados .= '<tr>
                            <td class="text-center">'.$obItensReservas->codBarras[$i].'</td>
                            <td class="text-center">'.$obItensReservas->titulos[$i].'</td>
                        </tr>';
    }

?>
<main>

    <section>
        <a href="<?=$_SERVER['HTTP_REFERER']?>" class="btn btn-primary">
            Voltar
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-return-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </a>
    </section>

    <h2 class="mt-3 text-secondary">Itens da Reserva</h2>

    <section style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
        <table class="table bg-white mt-4">
            <thead>
                <tr>
                    <th class="text-center">COD_LIVRO</th>
                    <th class="text-center">TITULO</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>
        </table>
    </section>


</main>