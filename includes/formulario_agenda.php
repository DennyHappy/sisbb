<main>

    <section>
        <a href="index.php" class="btn btn-primary">
            Voltar
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-return-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
            </svg>
        </a>
    </section>

    <h2 class="mt-3 text-secondary"><?=TITLE?></h2>

    <form method="post" class="form-inline">
        <div class="form-group col-4">
            <label>Data: </label>
            <input type="date" class="form-control col-12" name="agd_data" value="<?=$obAgenda->agd_data?>">
        </div>
        <div class="form-group col-4">
            <label>Hora Inicial: </label>
            <input type="time" class="form-control col-12" name="agd_hora_ini" value="<?=$obAgenda->agd_hora_ini?>">
        </div>
        <div class="form-group col-4">
            <label>Hora Final: </label>
            <input type="time" class="form-control col-12" name="agd_hora_fin" value="<?=$obAgenda->agd_hora_fin?>">
        </div>
        <div class="form-group col-4">
            <button type="submit" class="btn btn-success col-12 mt-4">Cadastrar</button>
        </div>
    </form>
</main>