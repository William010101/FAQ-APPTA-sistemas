<?php 
  include_once 'include/ref.php';
  include_once 'painel/services/PerguntaService.php';
  $service = new PerguntaService();
  

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
                <li class="breadcrumb-item text-uppercase" id="breadcrumb" aria-current="page">Resultados da pesquisa</li>
            </ol>
        </nav>

        <h2 class="hResultadoPesquisa">Resultados da pesquisa</h2>

        <div class="contagempesquisa mt-3 mb-4">
            <!-- <?php //echo $contagem['count']?> <a> resultados para "</a><?php //echo $pesquisar ?><a>"</a> -->
        </div>

        <div class="container mt-4">
        <?php
            var_dump($service->Pesquisa());
            //$pergunta = $perguntas->Pesquisa();
            // if(empty($pergunta)) {
            //     // Se $pergunta estiver vazia, exibir mensagem de nenhum resultado encontrado
            //     ?>
            <!-- //     <div class="container" id="semresultado">
            //         <a>Nenhum resultado encontrado!</a>
            //     </div> -->
            // <?php
            // } else {
            //     // Se $pergunta não estiver vazia, exibir as perguntas encontradas
            //     foreach ($pergunta as $perg): 
            // ?>
            <!-- //     <div class="card search">
            //         <div class="card-header video text-left" id="headvideo">
            //             <p class="blockquote pesquisa"><?php //echo $perg->pergunta?></p>
            //             <span class="d-inline-block text-truncate ml-4" style="max-width: 100%; max-height: 36px;">
            //                 <?php //echo $perg->resposta;?>
            //             </span>
            //             </h5>
            //         </div>
            //         <a href="resposta?id=<?php //echo $perg->id_pergunta; ?>" class="btn btn-recentes">Visualizar resposta completa</a>
            //     </div> -->
            // <?php //endforeach;
            //} ?>

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