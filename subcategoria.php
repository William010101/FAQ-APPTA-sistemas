
<?php
include_once 'include/ref.php';
include_once 'php_action/ClasseCategoria.php';
include_once 'php_action/ClasseSubcategoria.php';
include_once 'php_action/ClassePergunta.php';
$pergunta = new Pergunta();
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
            // $categorias = $categoria->GetNomeCategoria($_GET['id']);
            // // Acessando o primeiro elemento do array
            // $categoria = $categorias[0];
            // // Acessando a propriedade "nomeproduto" do objeto Produto
            // $nomecategoria = $categoria->nomecategoria;
            ?>

            <?php 
            $breadcrumb = $subcategoria->BreadCrumbSubcategoria($_GET['id']);
            foreach ($breadcrumb as $crumb):
                var_dump($crumb);  
            ?>
           
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-4">
                    <li class="breadcrumb-item text-uppercase">
                        <a id="breadcrumb" href="subcategoria?id=<?php echo $crumb = [0]; ?>"><?php echo $crumb = [1]; ?></a>
                    </li>
                    <li class="breadcrumb-item text-uppercase">
                        <a id="breadcrumb" href="subcategoria?id=<?php echo $crumb = [2]; ?>"><?php echo $crumb = [3]; ?></a>
                    </li>
                </ol>
            </nav>
            <h2 class="produtos-titulos mt-5 mb-5 ml-2"><?php echo strtoupper($crumb = [3]); ?></h2>
            <?php endforeach; ?>
            <div class="row">
            <?php
            $subcategorias = $subcategoria->GetSubcategorias($_GET['id']);
            foreach ($subcategorias as $sub):
                ?>
                        <div class="col-12 col-sm-6 mb-5">
                            <div class="card" style="height:100%; border-radius: 2.25rem;">
                                <h5 class="card-title recentes"> <?php echo $sub->nomesubcategoria; ?> </h5>
                                <div class="card-text categoria">
                                    <span class="d-inline-block text-truncate" style="max-width: 100%;">
                                    <?php
                                            $perguntas = $pergunta->GetPerguntas($sub->id_subcategoria);
                                            foreach ($perguntas as $perg):
                                                
                                                ?>
                                            <a href="#"
                                                class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                <?php echo $perg->pergunta; ?>
                                            </a><br>
                                    <?php endforeach; ?>
                                    </span>
                                </div>
                                <a href="perguntas?id=<?php echo $perg->id_pergunta ?>" class="btn btn-recentes">
                                    Visualizar todas as perguntas da subcategoria
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