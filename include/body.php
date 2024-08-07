<?php
include_once 'include/ref.php';
include_once 'php_action/ClasseProduto.php';
include_once 'php_action/ClasseConnection.php';
$produto = new Produto();
?>
<div class="container-fluid-page">
    <!-- Produtos categorias -->
    <div class="container">
        <h2 class="produtos-titulos ml-5 mt-5 mb-0">Todos os produtos</h2>
        <p class="produtos-sub-titulos mt-2 mb-1">Navegue pelas categorias para encontras mais informações<br> sobre a sua
            questão.
        </p>
    </div>
    <div class="container row mx-auto mb-5 text-center" id="corpo">

        <?php
        $produtos = $produto->GetProdutos();
        foreach ($produtos as $prod):
            ?>

            <div class="card-prod col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mx-auto mt-3 " style="width: 260px; height: 180px;">
                <div class="card w-75 mb-0 m-0 text-center mx-auto border-0 " style="width:100%; height:100%;">
                    <a style="width:100%; height: 87%;" href="categoria?id=<?php echo $prod->id_produto ?>">
                        <img class="mt-4" style="max-width:80%; height: 80%;"
                            src="data:image/png;base64,<?= base64_encode($prod->imagem) ?>" alt="">
                    </a>
                <div class="card-header-prod p-1 " style="height: 15%; width:100%">
                        <a style="height: 100%; width:100%;" href="categoria?id=<?php echo $prod->id_produto ?>"
                            class="btn btn-produtos-primario p-0"><?php echo mb_strtoupper($prod->nomeproduto, 'UTF-8') ?></a>
                </div>    
                </div>
                
            </div>
        <?php endforeach; ?>
    </div>
</div>