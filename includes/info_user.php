<main>

    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col-8">
                <h4>Bem-vindo <?=$_SESSION['nome']?></h4>
            </div>
            <div class="col-4 text-right">
                <p>Matricula: <?=$_GET['mtc']?></p>
                <p>E-mail: <?=$_SESSION['email']?></p>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="ver_minhas_reservas.php?mtc=<?=$_GET['mtc']?>" class="btn btn-info btn-sm">Minhas Reservas</a>
                    <a href="logout.php" class="btn btn-info btn-sm active">Sair</a>
                </div>
            </div>
        </div>
    </div>
            
</main>    