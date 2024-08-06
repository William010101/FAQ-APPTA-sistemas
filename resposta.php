<?php
include_once 'include/ref.php';
include_once 'php_action/ClassePergunta.php';
include_once 'php_action/ClasseResposta_Imagem.php';
$pergunta = new Pergunta();
$respostaimagem = new Respostaimagem();
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
            if ($breadcrumb) :

                foreach ($breadcrumb as $crumb) :
            ?>
                    <ol class="breadcrumb mt-4">
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb" href="categoria?id=<?php echo $crumb['id_produto']; ?>"><?php echo $crumb['nomeproduto']; ?></a>
                        </li>
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb" href="subcategoria?id=<?php echo $crumb['id_categoria']; ?>"><?php echo $crumb['nomecategoria']; ?></a>
                        </li>
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb" href="perguntas?subcategoria=<?php echo $crumb['nomesubcategoria']; ?>&id=<?php echo $crumb['id_subcategoria']; ?>"><?php echo $crumb['nomesubcategoria']; ?></a>
                        </li>
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb" href="resposta?id=<?php echo $crumb['id_pergunta']; ?>"><?php echo $crumb['pergunta']; ?></a>
                        </li>
                    </ol>
                <?php endforeach; ?>
                <?php else :
                $breadcrumbcat = $pergunta->BreadCrumbRepostaCat($_GET['id']);
                foreach ($breadcrumbcat as $crumb) :
                ?>
                    <ol class="breadcrumb mt-4">
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb" href="categoria?id=<?php echo $crumb['id_produto']; ?>"><?php echo $crumb['nomeproduto']; ?></a>
                        </li>
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb" href="perguntas?categoria=<?php echo $crumb['nomecategoria']; ?>&id=<?php echo $crumb['id_categoria']; ?>"><?php echo $crumb['nomecategoria']; ?></a>
                        </li>
                        <li class="breadcrumb-item text-uppercase">
                            <a id="breadcrumb" href="resposta?id=<?php echo $crumb['id_pergunta']; ?>"><?php echo $crumb['pergunta']; ?></a>
                        </li>
                    </ol>
                <?php endforeach; ?>
            <?php endif; ?>

        </nav>

        <?php
        $perguntas = $pergunta->GetPergunta($_GET['id']);
        foreach ($perguntas as $perg) :
        ?>
            <h1 class="titulo-pergunta mb-1"><?php echo $perg->pergunta ?></h1>
            <div class="author d-flex align-items-center row">

                <p class="mb-0" id="autorArtigo row">Escrito por <b><?php echo $perg->usuario; ?></b><br>
                    Data de publicação: <?php echo date("d/m/Y", strtotime($perg->datacadastro)); ?><br>

                </p>
                <?php
                if ($perg->dataedicao != null) :
                ?>
                    <p>Ultima edição em: <?php echo date("d/m/Y", strtotime($perg->dataedicao)); ?></p>
                <?php endif ?>

            </div>
            <hr>
            <div class="col-xs-12 p-3 pt-1 col-md-12 mb-50 mx-auto resposta-perguntalink">
                <p id="desc_resposta">DESCRIÇÃO:</p>
                <div class="mb-5" style="font-family:Verdana;"><?php echo $perg->resposta ?></div>
                <div class="social-icons-footer">
                    <di class="row">
                        <div class="imagemresposta">
                            <?php
                            $imagens = $respostaimagem->GetImagemRespostaPergunta($perg->id_pergunta);
                            foreach ($imagens as $imagem) :
                            ?>
                                <div class="text-center w-100 " style="background-color: #f6f6f6; border-radius: 10px;">
                                    <img class="mx-auto mt-4 img-fluid" src="data:image/png;base64,<?= base64_encode($imagem->imagem) ?>" alt="Imagem">
                                    <p class="mb-0" style="font-family:Verdana;"><?php echo mb_strtoupper($imagem->descricao, 'UTF-8'); ?></p><br>

                                </div>
                                
                                <div class="mt-5 mb-5 d-flex" style="font-family:Verdana;">
                                <?php if ($imagem->resposta):?>    
                                    <img src="img\ico\symbol-arrow-right.ico" style="width:13px; height:13px; margin-top: 21px; margin-right:3;">
                                    <div>
                                        <p><?php echo $imagem->resposta; ?></p>
                                    </div>
                                <?php endif; ?>    
                                </div>
                                
                            <?php endforeach; ?>

                        </div>
                        <?php if ($perg->solucao != "") : ?>
                            <p class="mt-5" id="desc_resposta">SOLUCÃO:</pcla>
                            <div class="mb-5" style="font-family:Verdana;"><?php echo $perg->solucao ?></div>
                        <?php endif; ?>
                        <?php if ($perg->video != "") : ?>

                            <div class="col-12 col-md-8 col-sm-10 mx-auto "">
                                <div class=" card video mt-5 mx-auto col-md-12 col-sm-12 col-12">
                                <div class="card-header video mx-auto col-sm-12 col-12" id="headvideo">
                                    <p class="blockquote video">ASSISTA AO VIDEO</p>
                                    <?php echo $perg->video ?>
                                </div>
                            </div>
                </div>

            <?php else : ?>

            <?php endif; ?>
            <hr class="mt-5">
            </div>
    </div>
<?php endforeach; ?>
</div>
<?php include_once 'include/footer.php' ?>

</body>

<script src="js/conteudo.js"></script>