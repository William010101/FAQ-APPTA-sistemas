<div class="container-fluid bg-primary">

    <div class="container" id="menupesquisacategoria">

        <div class="container">
            <div class="row ">
                <div class="col-sm-6">
                    <div class="dropdown mt-4 mb-4">
                        <a href="categoria?id=<?php echo $dados['id_produto']?>"></a>
                        <button class="btn dropdown-toggle" type="button" id="menudrop" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <?php echo strtoupper($nomeproduto);?>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="submenudrop">
                            <?php while($dados = pg_fetch_array($resultado)): ?>
                            <a class="dropdown-item"
                                href="categoria?id=<?php echo $dados['id_produto']?>"><?php echo strtoupper ($dados['nomeproduto']);?></a>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-3">
                    <form method="POST" action="search" novalidate>
                        <div class="input-group" id="pesquisacategoria">
                            <input type="search" name="pesquisar" class="form-control" placeholder="Pesquisar" required>
                            <div class="input-group-append">
                            <button class="btn " id="btnpesquisar" type="text"><i
                                        class="material-icons" id="">search</i></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>