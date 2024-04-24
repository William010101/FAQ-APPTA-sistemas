
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
                        <?php
                        $breadcrumb = $pergunta->BreadCrumbReposta($_GET['id']);
                        foreach ($breadcrumb as $crumb):
                        ?>
                        <ol class="breadcrumb mt-4">
                            <li class="breadcrumb-item text-uppercase">
                                <a id="breadcrumb" href="categoria?id=<?php echo $crumb['id_produto']; ?>"><?php echo $crumb['nomeproduto']; ?></a>
                            </li>
                            <li class="breadcrumb-item text-uppercase">
                                <a id="breadcrumb" href="subcategoria?id=<?php echo $crumb['id_categoria']; ?>"><?php echo $crumb['nomecategoria']; ?></a>
                            </li>
                            <li class="breadcrumb-item text-uppercase">
                                <a id="breadcrumb" href="perguntas?id=<?php echo $crumb['id_subcategoria']; ?>"><?php echo $crumb['nomesubcategoria']; ?></a>
                            </li>
                            <li class="breadcrumb-item text-uppercase">
                                <a id="breadcrumb" href="resposta?id=<?php echo $crumb['id_pergunta']; ?>"><?php echo $crumb['pergunta']; ?></a>
                            </li>
                        </ol>
                         <?php endforeach; ?>    
                    </nav>
         
               <?php
                $perguntas = $pergunta->GetResposta($_GET['id']);
                foreach ($perguntas as $perg):
                ?>
        <h1 class="titulo-pergunta mb-1"><?php echo $perg->pergunta ?></h1>
        <div class="author d-flex align-items-center">
            <a href="">
                <img src="<?php echo $perg->fotoPerfil; ?>" class="rounded-circle m-3" id="fotoAutorArtigo">
            </a>
            <p id="autorArtigo">Escrito por <b><?php echo $perg->usuario; ?></b><br>
                Data de publicação:
                <?php echo date("d/m/Y", strtotime($perg->datacadastro));?>
            </p>

        </div>

        <?php if ($perg->video != "") { ?>
            <div class="row">
                <div class="col">
                    <div class="card video">
                        <div class="card-header video" id="headvideo">
                            <p class="blockquote video">Assista ao video</p>
                            <h5 class="mb-0">

                                <button class="btn btn-video" type="button" data-toggle="collapse" data-target="#video">
                                    <a href="<?php echo $perg->video ?>"><?php echo $perg->pergunta ?></a>
                                </button>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
        } ?>
        <hr>
        <div class="col-xs-12 col-md-12 mb-50 body resposta-perguntalink">
            <?php echo $perg->resposta ?>
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
        <?php endforeach; ?>
    </div>
    <?php include_once 'include/footer.php' ?>
    
</body>
<script src="js/conteudo.js"></script>