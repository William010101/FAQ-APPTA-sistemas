<?php 
  include_once 'include/ref.php';
  include_once 'php_action/db_connect.php';
  include_once 'php_action/DAOsearch.php';
  $pagina = "search";
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
                <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Resultados da pesquisa</li>
            </ol>
        </nav>

        <h2 class="hResultadoPesquisa">Resultados da pesquisa</h2>

        <div class="contagempesquisa mt-3 mb-4">
            <?php echo $contagem['count']?> <a> resultados para "</a><?php echo $pesquisar ?><a>"</a>
        </div>

        <h3 class="hResultadoPesquisa">Base de conhecimento</h3>

        <div class="container mt-4">
            <?php
             if(pg_num_rows($resultadopesquisa) > 0){
                while($rows_pergunta = pg_fetch_array($resultadopesquisa)){
            ?>

            <div class="card search">
                <div class="card-header video text-left" id="headvideo">
                    <p class="blockquote video"><?php echo $rows_pergunta['produto']?></p>
                    <p class="blockquote pesquisa"><?php echo $rows_pergunta['pergunta']?></p>
                    <span class="d-inline-block text-truncate ml-4" style="max-width: 100%; max-height: 36px;">
                        <?php echo $rows_pergunta['resposta']?> ?>
                    </span>

                    </h5>

                </div>
                <a href="link?id=<?php echo $rows_pergunta['id_pergunta']; ?>" class="btn btn-recentes">Visualizar
                    resposta completa</a>
            </div>
            <?php } }else{ ?>
            <div class="container" id="semresultado">
                <a> Nenhum resultado encontrado! </a>
            </div>
            <?php }?>
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