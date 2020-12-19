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
                    <a href="add_carrinho.php" class="btn btn-info btn-sm active">
                        Itens no Carrinho 
                        <span class="badge badge-light">
                            <?php 
                            if(!empty($_SESSION['dados'])) {
                                echo "<pre>"; print_r($_SESSION['carrinho']); echo "</pre>";
                                echo "<pre>"; print_r($_SESSION['dados']); echo "</pre>";
                            }
                            ?>
                        </span>
                    </a>
                    <a href="ver_minhas_reservas.php?mtc=<?=$_SESSION['matricula']?>" class="btn btn-info btn-sm">Minhas Reservas</a>
                    <a href="logout.php" class="btn btn-info btn-sm active">Sair</a>
                </div>
            </div>
        </div>
    </div>
            
</main>    