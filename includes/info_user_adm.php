<main>

    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col-4">
                <p><strong>Bem-vindo </strong><?=$_SESSION['nome']?></p>
            </div>
            <div class="col-8 text-right">
                <p><strong>Matricula: </strong><?=$_SESSION['matricula']?></p>
                <p><strong>E-mail: </strong><?=$_SESSION['email']?></p>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="logout.php" class="btn btn-info btn-sm active">Sair</a>
                </div>
            </div>
        </div>
    </div>
            
</main>    