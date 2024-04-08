<!-- ------------------------------------------ -->

<?php
$sql = "SELECT * FROM pergunta inner join produto on nomeproduto = produto where resposta is not null ORDER BY 
id_pergunta DESC limit 2 ";
$resultado = pg_query($conn, $sql);

?>

<div class="container-fluid  ">
    <!-- Produtos categorias -->
    <div class="container row mx-auto m-4" id="corpo">

        <h2 class="produtos-titulos mt-7 mb-0">Todos os produtos</h2>
        <p class="produtos-sub-titulos mt-2">Navegue pelas categorias para encontras mais informações<br> sobre a sua
            questão.
        </p>
            <?php
            $sql = "SELECT * FROM produto where visivel = true  and categoria = 'Primario' ORDER BY
                        id_produto";
            $resultado = pg_query($conn, $sql);

            while ($dados = pg_fetch_array($resultado)): ?>

                
                    <div class="col-3 mx-auto">
                        <div class="card w-75 m-3" style="">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="180"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                
                            </svg>
                            <div class="card-header p-1">
                                <div class="text-center">
                                <a href="categoria?id=<?php echo ($dados['id_produto'])   ?>"
                            class="btn btn-produtos-primario p-0"><?php echo ($dados['nomeproduto'])   ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                

            <?php endwhile; ?>
            <!-- -----------------------Parte que exibe os produtos secundários na página inicial-------------------- -->
            <!-- <?php
            // $sql = "SELECT * FROM produto where visivel = true  and categoria = 'Secundario' ORDER BY
            // id_produto";
            //$resultado = pg_query($conn, $sql);
            
            //while ($dados = pg_fetch_array($resultado)):   ?>
            <?php //if($dados['categoria'] == "Secundario");   ?>

            <form method="POST" action="search" id="categoria">
                <input id="inputsubcategoria" type="hidden" name="pesquisar"
                    value="<?php //echo ($dados['nomeproduto'])   ?>">
                <button class="btn btn-produtos-secundario"><?php //echo strtoupper ($dados['nomeproduto'])   ?></button>
            </form>
            <?php //endwhile;  ?> -->
            <!-- -----------------------Parte que exibe os produtos secundários na página inicial-------------------- -->
    </div>
</div>