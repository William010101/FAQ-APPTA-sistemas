<?php
include_once 'include/ref.php';
include_once 'php_action/ClassePergunta.php';
$pergunta = new Pergunta();

?>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APPTA Sistemas</title>
</head>

<body>

    <?php include_once 'include/header.php'; ?>

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-4">
                <li class="breadcrumb-item text-uppercase" id="breadcrumb"><a href="inicio">Inicio</a></li>
                <li class="breadcrumb-item text-uppercase" id="breadcrumb" aria-current="page">Resultados da pesquisa
                </li>
            </ol>
        </nav>

        <h2 class="hResultadoPesquisa">Resultados da pesquisa</h2>

        <div class="container mt-4">
            <?php
            $perguntas = $pergunta->Pesquisar();
            if (empty($perguntas)):
                ?>
                <div class="contagempesquisa mt-3 mb-4">
                     <?php echo count($perguntas) ?> <a> resultados para "</a><?php echo $_POST['pesquisar'] ?><a>"</a>
                </div>
                <div class="container" id="semresultado">
                    <a>Nenhum resultado encontrado!</a>
                </div>
            <?php else:
                foreach ($perguntas as $perg):

                    ?>
                    <div class="col-12 col-sm-12 mb-5">
                        <div class="card">

                            <div class="card-header text-white">
                                <p id="textocaminho" class="card-text h6 text-white">

                                    <?php
                                    if($perg['nomesubcategoria'] != ''){
                                     echo $perg['nomeproduto'] . " / " . $perg['nomecategoria'] . " / " . $perg['nomesubcategoria'] . " / " . $perg['pergunta']; 
                                    }else{
                                    echo $perg['nomeproduto'] . " / " . $perg['nomecategoria'] . " / " . $perg['pergunta']; 
                                    }
                                     ?>
                                </p>
                                <?php echo $perg['pergunta']; ?>
                            </div>

                            <div class="card-body p-2">
                                <p class="card-text">
                                    <?php
                                    $texto = $perg['resposta'];
                                    // Verifica se o comprimento da resposta é maior que 342
                                    if (strlen($texto) > 401) {
                                        $texto = substr($texto, 0, 401);
                                        $texto .= "...";
                                    }
                                    echo $texto;
                                    ?>
                                </p>

                                <a href="resposta?id=<?php echo $perg['id_pergunta']; ?>" class="btn-listar mt-2 ">visualizar
                                    resposta completa</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>


        </div>

    </div>
    <div class="container-fluid">
        <!-- Produtos categorias -->
        <div class="container" id="naoencontrou">
            <p class="naoencontrou-title">
                Não encontrou o<br> que precisava?
            </p>
            <p class="nãoencontrou-sub-title">
                Entre em contato com a gente para<br> receber suporte personalizado.
            </p>
            <a href="#" class="btn btn-contato" role="button">Entre em contato</a>
        </div>
    </div>
</body>
<?php include_once 'include/footer.php'; ?>

</html>