<!-- ------------------------------------------ -->

<?php
$sql = "SELECT * FROM pergunta inner join produto on nomeproduto = produto where resposta is not null ORDER BY 
id_pergunta DESC limit 2 ";
$resultado = pg_query($conn, $sql);

?>

<div class="container-fluid">
    <div class="container" id="recentes">
        <h2 class="produtos-titulos">
            RECENTEMENTE<br>ADICIONADAS
        </h2>
        <div class="row">
            <?php   while($dados = pg_fetch_array($resultado)): ?>
            <div class="col-12 col-sm-6 mb-5">
                <div class="card recentes">
                    <h5 class="card-title recentes"> <?php echo $dados['pergunta']; ?> </h5>
                    <div class="card-text recentes">
                        <span class="d-inline-block text-truncate" style="max-width: 100%;">
                            <?php echo $dados['resposta']; ?>
                        </span>
                    </div>
                    <form method="POST" action="php_action/DAOcontagem.php?id=<?php echo $dados['id_pergunta'];?>"
                        id="formRecentes">
                        <button type="submit" name="btnAcessos" class="btn btn-recentes">Visualizar
                            resposta completa</button>
                    </form>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

    </div>

</div>


<div class="container-fluid">
    <!-- Produtos categorias -->
    <div class="container" id="acessadas">
        <h2 class="produtos-titulos mt-5 mb-4">Mais acessadas </h2>
        <div class="row d-flex justify-content-left">
            <?php
           $sql = "SELECT * FROM pergunta where resposta is not null ORDER BY
           numacessos DESC limit 8 ";
            $resultado = pg_query($conn, $sql);

            while ($dados = pg_fetch_array($resultado)): ?>
            <!-- <div class="col-lg-3"> -->
            <div class="col-12 col-sm-6">

                <form method="POST" action="php_action/DAOcontagem.php?id=<?php echo $dados['id_pergunta']; ?>">
                    <button type="submit" name="btnAcessos" class="btn btn-acessados"><?php echo $dados['pergunta']; ?>
                    </button>
                </form>
            </div>
            <?php endwhile;?>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- Produtos categorias -->
    <div class="container" id="corpo">

        <h2 class="produtos-titulos mt-5 mb-4">Todas Categorias </h2>
        <p class="produtos-sub-titulos">Navegue pelas categorias para encontras mais informações<br> sobre a sua
            questão.
        </p>
        <div class="row d-flex justify-content-left">
            <?php
            $sql = "SELECT * FROM produto where visivel = true  and categoria = 'Primario' ORDER BY
                        id_produto";
            $resultado = pg_query($conn, $sql);

            while ($dados = pg_fetch_array($resultado)): ?>
            <a href="categoria?id=<?php echo ($dados['id_produto']) ?>"
                class="btn btn-produtos-primario"><?php echo strtoupper ($dados['nomeproduto']) ?></a>
            <?php endwhile;?>

            <?php
            $sql = "SELECT * FROM produto where visivel = true  and categoria = 'Secundario' ORDER BY
                        id_produto";
            $resultado = pg_query($conn, $sql);

            while ($dados = pg_fetch_array($resultado)): ?>
            <?php if($dados['categoria'] == "Secundario"); ?>

            <form method="POST" action="search" id="categoria">
                <input id="inputsubcategoria" type="hidden" name="pesquisar"
                    value="<?php echo ($dados['nomeproduto']) ?>">
                <button class="btn btn-produtos-secundario"><?php echo strtoupper ($dados['nomeproduto']) ?></button>
            </form>

            <?php endwhile;?>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- Produtos categorias -->
    <div class="container" id="naoencontrou">

        <p class="naoencontrou-title">
            Não encontrou o<br> que precisava?
        </p>
        <p class="nãoencontrou-sub-title">
            Entre em contato com a gente para<br> receber suporte personalizado.
        </p>
        <a href="#" class="btn btn-contato" role="button">Entre em contato</a>
    </div>
</div>