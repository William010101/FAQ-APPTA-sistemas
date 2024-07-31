<?php
include_once 'include/ref.php';
include_once 'php_action/ClassePergunta.php';
$pergunta = new Pergunta();
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

            <?php if (isset($_GET['categoria'])):
               $breadcrumbCat = $pergunta->BreadCrumbPerguntaCat($_GET['categoria']);
                    foreach ($breadcrumbCat as $crumb):
                    ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4">
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb"
                                href="categoria?id=<?php echo $crumb['id_produto']; ?>"><?php echo $crumb['nomeproduto']; ?></a>
                        </li>

                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb"
                                href="perguntas?categoria=<?php echo $crumb['nomecategoria']; ?>&id=<?php echo $crumb['id_categoria']; ?>"><?php echo $crumb['nomecategoria']; ?></a>
                    <?php endforeach; ?>
                    </ol>
                </nav>
                <h2 class="produtos-titulos mt-2 mb-5 ml-2"><?php echo strtoupper($crumb['nomecategoria']); ?></h2>
                        
                <?php else:
                    $breadcrumb = $pergunta->BreadCrumbPergunta($_GET['id']);
                    foreach ($breadcrumb as $crumb):
                    ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4">
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb"
                                href="categoria?id=<?php echo $crumb['id_produto']; ?>"><?php echo $crumb['nomeproduto']; ?></a>
                        </li>

                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb"
                                href="subcategoria?id=<?php echo $crumb['id_categoria']; ?>"><?php echo $crumb['nomecategoria']; ?></a>
                        </li>
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb"
                                href="perguntas?subcategoria=<?php echo $crumb['nomesubcategoria']; ?>&id=<?php echo $crumb['id_subcategoria']; ?>"><?php echo $crumb['nomesubcategoria']; ?></a>
                        </li>
                        
                    <?php endforeach; ?>
                    </ol>
                </nav>
                <h2 class="produtos-titulos mt-2 mb-5 ml-2"><?php echo strtoupper($crumb['nomesubcategoria']); ?></h2>
            <?php endif; ?>
            <div class="row">
                <h2 class="titulos mt-2 mb-5 ml-2 text-center">Perguntas</h2>
                <?php
                if (isset($_GET['categoria'])):
                    $perguntas = $pergunta->GetCatPerguntas($_GET['categoria'], $_GET['id']);

                    foreach ($perguntas as $perg):

                        ?>
                        <div class="col-12 col-sm-12 mb-5">
                            <div class="card">
                            <div style="height: 36px; font-weight:bolder;" class="card-header text-center text-white">
                                    <?php echo  mb_strtoupper($perg->pergunta, 'UTF-8'); ?>
                                </div>
                                <div class="card-body p-2">
                                <p id="desc_resposta">DESCRIÇÃO:</p>
                                    <p class="card-text">
                                        <?php
                                        $texto = $perg->resposta;

                                        if (strlen($texto) > 401) {
                                            $texto = substr($texto, 0, 401);
                                            $texto .= "...";
                                        }
                                        echo $texto;
                                        ?>
                                    </p>

                                    <a href="resposta?id=<?php echo $perg->id_pergunta; ?>" class="btn-listar mt-2 ">VISUALIZAR RESPOSTA COMPLETA</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else:
                    $perguntas = $pergunta->GetSubPerguntas($_GET['subcategoria'], $_GET['id']);
                    foreach ($perguntas as $perg):
                        ?>
                        <div class="col-12 col-sm-12 mb-5">
                            <div class="card">
                                <div style="height: 36px; font-weight:bolder;" class="card-header text-center text-white">
                                    <?php echo mb_strtoupper($perg->pergunta, 'UTF-8');; ?>
                                </div>
                                <div class="card-body p-2">
                                <p id="desc_resposta">DESCRIÇÃO:</p>
                                    <p class="card-text">
                                        <?php
                                        $texto = $perg->resposta;

                                        if (strlen($texto) > 401) {
                                            $texto = substr($texto, 0, 401);
                                            $texto .= "...";
                                        }
                                        echo $texto;
                                        ?>
                                    </p>

                                    <a href="resposta?id=<?php echo $perg->id_pergunta; ?>" class="btn-listar mt-2 ">VISUALIZAR RESPOSTA COMPLETA</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

<footer>
    <?php include_once 'include/footer.php' ?>
</footer>