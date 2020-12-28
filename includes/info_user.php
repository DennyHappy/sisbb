<main>

    <div class="alert alert-light" role="alert">
        <div class="row">
            <div class="col-4">
                <p><strong>Bem-vindo </strong><?=$_SESSION['nome']?></p>
            </div>
            <div class="col-8 text-right">
                <p><strong>Matricula: </strong><?=$_SESSION['mtcl']?></p>
                <p><strong>E-mail: </strong><?=$_SESSION['email']?></p>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="index.php" class="btn btn-info btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                        </svg>
                        Inicio
                    </a>
                    <a href="add_carrinho.php" class="btn btn-info btn-sm active">
                        Itens no Carrinho 
                        <span class="badge badge-light">
                            <?=(!empty($_SESSION['dados']) ? count($_SESSION['carrinho']) : '0')?>
                        </span>
                    </a>
                    <a href="ver_minhas_reservas.php?mtc=<?=$_SESSION['matricula']?>" class="btn btn-info btn-sm">Minhas Reservas</a>
                    <a href="../logout.php" class="btn btn-info btn-sm active">Sair</a>
                </div>
            </div>
        </div>
    </div>
            
</main>    