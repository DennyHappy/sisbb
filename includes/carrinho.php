<main>

    <h2 class="mt-3 text-secondary">Itens no Carrinho</h2>
    
    <hr>
    <form action="?acao=up" method="post">
    <a href="view1.php" class="btn btn-primary btn-sm">Adicionar mais itens</a>
    <a href="view1.php" class="btn btn-primary btn-sm end">proceguir</a>
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