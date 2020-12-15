<main>

    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col-8">
                <h4>Bem-vindo <?=$_SESSION['nome']?></h4>
            </div>
            <div class="col-4 text-right">
                <p>E-mail: <?=$_SESSION['email']?></p>
                <a href="logout.php" class="btn btn-info btn-sm col-6">Sair</a>
            </div>
        </div>
    </div>
            
</main>    