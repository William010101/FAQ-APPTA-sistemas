<!-- ------------------------------------------ -->

<?php
// $sql = "SELECT * FROM produto";
// // "SELECT * FROM pergunta inner join produto on nomeproduto = produto where resposta is not null ORDER BY 
// // id_pergunta DESC limit 2 ";
// $resultado = pg_query($conn, $sql);

?>

<div class="container-fluid  ">
    <!-- Produtos categorias -->
    <div class="container row mx-auto m-4" id="corpo">

        <h2 class="produtos-titulos mt-5 mb-0">Todos os produtos</h2>
        <p class="produtos-sub-titulos mt-2">Navegue pelas categorias para encontras mais informações<br> sobre a sua
            questão.
        </p>
            <?php
            $sql = "SELECT * FROM produto where visivel = true ORDER BY
                        id_produto";
            $resultado = pg_query($conn, $sql);

            while ($dados = pg_fetch_array($resultado)): ?>

                
                    <div class="col-3 mx-auto h-50">
                        <div class="card w-75 m-3 text-center bg-primary" >                         
                             <img class="img-fluid w-75 mx-auto" src="../img/appta.png" alt="">
                            <div class="card-header p-1">                                
                                <a href="categoria?id=<?php echo ($dados['id_produto'])   ?>"
                            class="btn btn-produtos-primario p-0"><?php echo ($dados['nomeproduto'])   ?></a>                               
                            </div>
                        </div>
                    </div>
                

            <?php endwhile; ?>
    </div>
</div>