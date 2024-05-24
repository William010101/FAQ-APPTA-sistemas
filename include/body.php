<?php
include_once 'include/ref.php';
include_once 'php_action/ClasseProduto.php';
include_once 'php_action/ClasseConnection.php';
$produto = new Produto();
?>
<div class="container-fluid">
    <!-- Produtos categorias -->
    <div class="container">
    <h2 class="produtos-titulos ml-5 mt-5 mb-0">Todos os produtos</h2>
        <p class="produtos-sub-titulos mt-2">Navegue pelas categorias para encontras mais informações<br> sobre a sua
            questão.
        </p>
    </div>
    <div class="container row mx-auto m-4 text-center" id="corpo">
  
            <?php
            $produtos = $produto->GetProdutos();
            foreach ($produtos as $prod):  
                ?>
                
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mx-auto mt-4" >
                        <div class="card w-75 mb-0 m-0 text-center mx-auto bg-primary " style=" height: 100%;">                         
                             <img class="img-fluid  mx-auto" style="width:97%; height: 97%;" src="data:image/png;base64,<?= base64_encode($prod->imagem) ?>" alt="">
                            <div class="card-header p-1 w-100" style="height: 18%;">                                
                                <a style="height: 100%;" href="categoria?id=<?php echo $prod->id_produto ?>"
                            class="btn btn-produtos-primario p-0"><?php echo $prod->nomeproduto ?></a>                               
                            </div>
                        </div>
                    </div>               
            <?php endforeach; ?>
    </div>
</div>