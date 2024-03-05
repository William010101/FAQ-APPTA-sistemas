<?php 
  include_once 'include/ref.php';
  include_once 'php_action/db_connect.php';
  include_once 'php_action/DAOlink.php';
  $pagina = "link";
?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APPTA Sistemas - <?php echo($dados['pergunta']) ?></title>
</head>

<body>

    <?php include_once 'include/header.php'; ?>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-5">
                <li class="breadcrumb-item text-uppercase"><a href="inicio" id="breadcrumb">Inicio</a></li>
                <li class="breadcrumb-item text-uppercase"><a id="breadcrumb"
                        href="categoria?id=<?php echo $idproduto ?>"><?php echo $produto ?></a>
                </li>
                <li class="breadcrumb-item text-uppercase active" name="pesquisar">
                    <?php echo($dados['pergunta']) ?></li>

            </ol>
        </nav>
        <form method="POST" action="search">
            <div class="categoriaslink">

                <label for="categorias" id="categoriasAtivas">Categorias</label>
                <a class="btn btn-produtos-primario mb-0"
                    href="categoria.php?id=<?php echo $idproduto ?>"><?php echo $produto?></a>

                <button class="btn btn-produtos-secundario" style="width: 10.1rem;margin-top: 2%;"> <input
                        name="pesquisar" style="display:none"
                        value='<?php echo $subcategoria?>'><?php echo $subcategoria?></button>

            </div>
        </form>
        <h1 class="titulo-pergunta mb-1"><?php echo $pergunta ?></h1>
        <div class="author d-flex align-items-center">
            <a href="">
                <img src="<?php echo $fotoPerfil?>" class="rounded-circle m-3" id="fotoAutorArtigo">
            </a>
            <p id="autorArtigo">Escrito por <b><?php echo $usuario ?></b><br>
                Data de publicação:
                <?php $var =  ($dados['datacadastro']); echo date("d/m/Y", strtotime($var) );?> </p>
              
        </div>

        <?php if($video != "")
        {  ?>
        <div class="row">
            <div class="col">
                <div class="card video">
                    <div class="card-header video" id="headvideo">
                        <p class="blockquote video">Assista ao video</p>
                        <h5 class="mb-0">

                            <button class="btn btn-video" type="button" data-toggle="collapse" data-target="#video">
                                <?php echo $pergunta ?>
                            </button>
                        </h5>
                    </div>
                    <div class="collapse" id="video">
                        <div class="card card-body">
                            <?php echo $video ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }else{ }?>
        <hr>
        <div class="col-xs-12 col-md-12 mb-50 body resposta-perguntalink">
            <?php echo  $resposta ?>
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

        <div class="perguntasvizinhas" >
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="card video mb-2 mb-sm-0">
                        <div class="card-header video text-right pb-0" id="headvideo">
                            <p class="blockquote video mr-3">Pergunta anterior</p>
                          
                        </div>
                        <div class="card-body text-right py-0">
                        <h5 class="mb-0">
                                <?php if( $perguntaAnterior != null): ?>
                                <form method="POST" 
                                    action="php_action/DAOcontagem.php?id=<?php echo $idperguntaAnterior?>" >
                                    <button class="btn btn-video text-right" type="submit" name="btnAcessos">
                                        <?php echo $perguntaAnterior?>
                                    </button>
                                </form>
                                <?php else: ?>
                                <form method="POST" action="php_action/DAOcontagem.php?id=<?php echo $idpergunta ?>">
                                    <button class="btn btn-video text-right" type="submit" name="btnAcessos">
                                        <?php echo $pergunta ?>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </h5></div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="card video mb-2 mb-sm-0">
                        <div class="card-header video pb-0" id="headvideo">
                            <p class="blockquote video">Próxima pergunta</p>
                           
                        </div>
                        <div class="card-body py-0">
                        <h5 class="mb-0">
                                <?php if( $perguntaProximo != null): ?>
                                <form method="POST"
                                    action="php_action/DAOcontagem.php?id=<?php echo $idperguntaProximo ?>">
                                    <button class="btn btn-video text-left" type="submit" name="btnAcessos">
                                        <?php echo $perguntaProximo ?>
                                    </button>
                                </form>
                                <?php else: ?>
                                <form method="POST" action="php_action/DAOcontagem.php?id=<?php echo $idpergunta ?>">
                                    <button class="btn btn-video text-left" type="submit" name="btnAcessos">
                                        <?php echo $pergunta ?>
                                    </button>
                                </form>
                                <?php endif; ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Produtos categorias -->
        <div class="relacionadas">
            <h2 class="produtos-titulos mt-5 mb-4">PERGUNTAS <br>RELACIONADAS </h2>
            <div class="row d-flex justify-content-left">
                <?php
            while ($dadosRelacionados = pg_fetch_array($resultado)): ?>

                <div class="col-12 col-sm-6">
                    <form method="POST" action="php_action/DAOcontagem.php?id=<?php echo $dados['id_pergunta']; ?>">
                        <button class="btn btn-relacionadas" type="submit"
                            name="btnAcessos"><?php echo $dadosRelacionados['pergunta']; ?> <i
                                class="fas fa-chevron-right"></i></button>
                    </form>
                </div>
                <?php endwhile;?>
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


    </div>
    <?php include_once 'include/footer.php' ?>
</body>
<script src="js/conteudo.js"></script>


</html>