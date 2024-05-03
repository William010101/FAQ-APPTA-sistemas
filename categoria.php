<?php
include_once 'include/ref.php';
include_once 'php_action/ClasseCategoria.php';
include_once 'php_action/ClasseSubcategoria.php';
include_once 'php_action/ClasseProduto.php';
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
            $produto = $produtos[0];
            $idproduto = $produto->id_produto;
            $nomeproduto = $produto->nomeproduto;
            ?>
            <?php //endforeach; ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-5">
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb"
                                href="categoria?id=<?php echo $idproduto; ?>"><?php echo $nomeproduto ?></a>
                        </li>
                    </ol>
                    <h2 class="produtos-titulos mt-5 mb-5 ml-2"><?php echo strtoupper($nomeproduto); ?></h2>
                    <div class="row">
                    
                    <?php
                    $categorias = $categoria->GetCategorias();
                    foreach ($categorias as $cat):
                        
                        ?>
                            <div class="col-12 col-sm-6 mb-5">
                                <div class="card" style="height:100%; border-radius: 2.25rem;">
                                    <h5 class="card-title recentes">
                                        <?php echo $cat->nomecategoria; ?>
                                    </h5>
                                    <div class="card-text categoria">
                                        <span class="d-inline-block text-truncate" style="max-width: 100%;">
                                            <?php
                                            $subcategorias = $subcategoria->GetSubcategorias($cat->id_categoria);
                                            foreach ($subcategorias as $sub):
                                                ?>
                                                    <a href="subcategoria?id=<?php echo $cat->id_categoria; ?>"
                                                        class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                        <?php echo $sub->nomesubcategoria ?>
                                                    </a><br>
                                            <?php endforeach; ?>
                                        </span>
                                    </div>
                                    <a href="subcategoria?id=<?php echo $cat->id_categoria; ?>" class="btn btn-recentes">
                                        Visualizar todas subcategorias
                                    </a>
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