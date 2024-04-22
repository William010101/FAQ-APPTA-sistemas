
<?php
include_once 'include/ref.php';
include_once 'php_action/OBJcategoria.php';
include_once 'php_action/OBJsubcategoria.php';
include_once 'php_action/OBJpergunta.php';
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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-4">
                    <?php //echo exibe_nome_categoria($conn, $idcategoria); ?>
                    <li class="breadcrumb-item text-uppercase">
                        <a id="breadcrumb" href="categoria?id=<?php //echo $idproduto ?>"><?php //echo //$nomeproduto ?></a>
                    </li>
                    
                </ol>
            </nav>
            <h2 class="produtos-titulos mt-5 mb-5 ml-2"><?php //echo strtoupper($nomecategoria); ?></h2>

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
                                <a href="perguntas?id=<?php echo $sub->id_subcategoria ?>" class="btn btn-recentes">
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