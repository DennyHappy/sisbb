<main>

    <h2 class="mt-3 text-secondary">Itens no Carrinho</h2>
    
    <hr>
    <form action="?acao=up" method="post">
    <a href="index.php" class="btn btn-primary btn-sm">Adicionar mais itens</a>
    <a href="ver_horarios.php" class="btn btn-primary btn-sm end">Prosseguir</a>
    <hr>
    <section style="overflow-x: scroll; overflow-y: hidden; white-space: nowrap;">
        <table class="table bg-white text-center">
            <thead>
                <tr>
                    <th class="text-center">COD. BARRAS</th>
                    <th class="text-center">TITULO</th>
                    <th class="text-center">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>
        </table>
    </section>
    </form>
</main>