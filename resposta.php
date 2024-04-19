<?php
include_once 'include/ref.php';
include_once 'php_action/db_connect.php';
include_once 'php_action/DAOresposta.php';
$pagina = "link";
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APPTA Sistemas - <?php echo ($dados['pergunta']) ?></title>
</head>

<body>

    <?php include_once 'include/header.php'; ?>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-4">
                <?php //echo exibe_nome_categoria($conn, $idcategoria); ?>
                <li class="breadcrumb-item text-uppercase">
                    <a id="breadcrumb" href="categoria?id=<?php echo $idproduto ?>"><?php echo $nomeproduto ?></a>
                </li>
                <li class="breadcrumb-item text-uppercase">
                    <a id="breadcrumb" href="categoria?id=<?php echo $idcategoria ?>"><?php echo $nomecategoria ?></a>
                </li>
                <li class="breadcrumb-item text-uppercase">
                    <a id="breadcrumb"
                        href="categoria?id=<?php echo $idsubcategoria ?>"><?php echo $nomesubcategoria ?></a>
                </li>
                <li class="breadcrumb-item text-uppercase">
                    <a id="breadcrumb"
                        href="subcategoria?id=<?php echo $idpergunta ?>"><?php echo $pergunta ?></a>
                </li>
            </ol>
        </nav> 
        <h1 class="titulo-pergunta mb-1"><?php echo $pergunta ?></h1>
        <div class="author d-flex align-items-center">
            <a href="">
                <img src="<?php echo $fotoPerfil ?>" class="rounded-circle m-3" id="fotoAutorArtigo">
            </a>
            <p id="autorArtigo">Escrito por <b><?php echo $usuario ?></b><br>
                Data de publicação:
                <?php $var = ($dados['datacadastro']);
                echo date("d/m/Y", strtotime($var)); ?>
            </p>

        </div>

        <?php if ($video != "") { ?>
            <div class="row">
                <div class="col">
                    <div class="card video">
                        <div class="card-header video" id="headvideo">
                            <p class="blockquote video">Assista ao video</p>
                            <h5 class="mb-0">

                                <button class="btn btn-video" type="button" data-toggle="collapse" data-target="#video">
                                    <a href="<?php echo $video ?>"><?php echo $pergunta ?></a>
                                </button>
                            </h5>
                        </div>
                        <!-- <div class="collapse" id="video">
                        <div class="card card-body">
                            <?php //echo $video ?>
                        </div>
                    </div> -->
                    </div>
                </div>
            </div>
        <?php } else {
        } ?>
        <hr>
        <div class="col-xs-12 col-md-12 mb-50 body resposta-perguntalink">
            <?php echo $resposta ?>
            <div class="social-icons-footer">
                <hr>
                <span class="RobotoRegular">Compartilhe esse conteúdo:</span><br>
                <a target="_blank" class="btn btn-outline-success" id="whatsapp-share-btt"><i
                        class="fab fa-whatsapp"></i>
                    <span>Whatsapp</span></a>
                <a target="_blank" class="btn btn-outline-primary" id="facebook-share-btt"><i
                        class="fab fa-facebook"></i>
                    <span>Facebook</span></a>
            </div>
        </div>
    </div>
    <?php include_once 'include/footer.php' ?>
</body>
<script src="js/conteudo.js"></script>


</html>