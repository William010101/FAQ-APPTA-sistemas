<?php
include_once 'include/ref.php';
include_once 'php_action/ClasseCategoria.php';
include_once 'php_action/ClasseSubcategoria.php';
include_once 'php_action/ClasseProduto.php';
include_once 'php_action/ClassePergunta.php';
$pergunta = new Pergunta();
$produto = new Produto();
$categoria = new Categoria();
$subcategoria = new Subcategoria();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APPTA Sistemas</title>
</head>
<?php include_once 'include/header.php'; ?>

<body>


    <div class="container-fluid">
        <div class="container">
            <?php
            $produtos = $produto->GetProduto($_GET['id']);
            foreach($produtos as $prod):
            ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-5">
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb"
                                href="categoria?id=<?php echo $prod->id_produto; ?>"><?php echo $prod->nomeproduto; ?></a>
                        </li>
                    </ol>
            <?php endforeach; ?>  
                    <h2 class="produtos-titulos mt-2 mb-2 ml-2"><?php echo strtoupper($prod->nomeproduto); ?></h2>
                    <div class="row">
                    <h2 class="titulos mt-2 mb-5 ml-2 text-center" >Categorias</h2>
                    <?php
                    $categorias = $categoria->GetCategorias($_GET['id']);
                    foreach ($categorias as $cat):
                        
                        ?>
                            <div class="col-12 col-sm-6 mb-5">
                                <div class="card" style=" max-height:100%; border-radius: 2.25rem 2.25rem 1rem 1rem;">
                                    <h5 class="card-title recentes">
                                        <?php echo $cat->nomecategoria; ?>
                                    </h5>
                                    <div class="card-text categoria pb-4 ">
                                        <span class="d-inline-block d-flex flex-column" style="max-width: 100%; max-height: 100%; ">
                                            <?php
                                            $subcategorias = $subcategoria->GetSubcategorias($cat->id_categoria);
                                            if ($subcategorias):
                                            
                                            foreach ($subcategorias as $sub):
                                                ?>
                                                    <li><a href="perguntas?subcategoria=<?php echo $sub->nomesubcategoria; ?>&id=<?php echo $sub->id_subcategoria; ?>"
                                                        class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                        <?php echo $sub->nomesubcategoria ?>
                                                    </a></li>
                                            <?php endforeach; ?>
                                            
                                        </span>
                                        <!-- //<p class="mt-1 mb-0">Para ver mais subcategorias clique no botão abaixo</p> -->
                                        
                                    </div>
                                    
                                    <a href="subcategoria?id=<?php echo $cat->id_categoria; ?>" class="btn btn-recentes">
                                        Visualizar todas subcategorias
                                    </a>
                                    <?php else: ?>
                                    <?php
                                        $perguntas = $pergunta->GetPerguntasCat( $cat->id_categoria );
                                        foreach ($perguntas as $perg):
                                            ?>
                                                    <a href="resposta?id=<?php echo $perg->id_pergunta ?>"
                                                        class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                        <?php echo $perg->pergunta; ?>
                                                    </a><br>
                                        <?php endforeach; ?>
                                        </span>
                                    </div>
                                    <a href="perguntas?categoria=<?php echo $cat->nomecategoria?>&id=<?php echo $cat->id_categoria?>" class="btn btn-recentes">
                                        Visualizar todas as perguntas da Categoria
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                    <?php endforeach; ?>
                </div>
        </div>
    </div>
</body>
<footer>
    <?php include_once 'include/footer.php' ?>
</footer>