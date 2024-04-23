<?php
include_once 'include/ref.php';
include_once 'php_action/ClasseProduto.php';
include_once 'php_action/ClasseConnection.php';
$produto = new Produto();
?>
<div class="container-fluid  ">
    <!-- Produtos categorias -->
    <div class="container row mx-auto m-4" id="corpo">

        <h2 class="produtos-titulos mt-5 mb-0">Todos os produtos</h2>
        <p class="produtos-sub-titulos mt-2">Navegue pelas categorias para encontras mais informações<br> sobre a sua
            questão.
        </p>
            <?php
            $produtos = $produto->GetProdutos();
            foreach ($produtos as $prod):  
                ?>

                
                    <div class="col-3 mx-auto h-50">
                        <div class="card w-75 m-3 text-center bg-primary" >                         
                             <img class="img-fluid w-75 mx-auto" src="../img/appta.png" alt="">
                            <div class="card-header p-1">                                
                                <a href="categoria?id=<?php echo $prod->id_produto ?>"
                            class="btn btn-produtos-primario p-0"><?php echo $prod->nomeproduto ?></a>                               
                            </div>
                        </div>
                    </div>
                

            <?php endforeach; ?>
    </div>
</div>