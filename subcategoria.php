<<<<<<< HEAD
<?php
include_once 'include/ref.php';
include_once 'php_action/db_connect.php';
include_once 'php_action/DAOsubcategoria.php';

$pagina = "subcategoria";
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
            //filtro de subcategorias ativas
            $sql = "SELECT * FROM subcategoria WHERE $idcategoria  = fk_id_categoria and visivel = true";
            $resultado = pg_query($conn, $sql);
            ?>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-4">
                    <?php //echo exibe_nome_categoria($conn, $idcategoria); ?>
                    <li class="breadcrumb-item text-uppercase">
                        <a id="breadcrumb" href="categoria?id=<?php //echo //$idproduto ?>"><?php //echo //$nomeproduto ?></a>
                    </li>
                    
                </ol>
            </nav>
            <h2 class="produtos-titulos mt-5 mb-5 ml-2"><?php echo strtoupper($nomecategoria); ?></h2>

            <div class="row">
                <?php while ($dados = pg_fetch_array($resultado)): ?>
                    <div class="col-12 col-sm-6 mb-5">
                        <div class="card" style="height:100%; border-radius: 2.25rem;">
                            <h5 class="card-title recentes"> <?php echo $dados['nomesubcategoria']; ?> </h5>
                            <div class="card-text categoria">

                                <span class="d-inline-block text-truncate" style="max-width: 100%;">
                                    <?php
                                    $idsubcategoria = $dados['id_subcategoria'];
                                    $sqlpergunta = "SELECT * FROM pergunta WHERE fk_id_subcategoria = $idsubcategoria and visivel = true";
                                    $resultadopergunta = pg_query($conn, $sqlpergunta);
                                    while ($dadospergunta = pg_fetch_array($resultadopergunta)): ?>
                                        <a href="#"
                                            class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><?php echo ($dadospergunta['pergunta']) ?></a><br>

                                    <?php endwhile; ?>

                                </span>
                            </div>
                            <a href="perguntas?id=<?php echo ($dados['id_subcategoria'])?>" class="btn btn-recentes">
                                Visualizar todas as perguntas da subcategoria
                            </a>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>


        </div>
    </div>
</body>

<footer>
    <?php include_once 'include/footer.php' ?>
</footer>

=======
<?php
include_once 'include/ref.php';
include_once 'php_action/db_connect.php';
include_once 'php_action/DAOsubcategoria.php';

$pagina = "subcategoria";
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
            //filtro de subcategorias ativas
            $sql = "SELECT * FROM subcategoria WHERE $idcategoria  = fk_id_categoria and visivel = true";
            $resultado = pg_query($conn, $sql);
            ?>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-4">
                    <?php //echo exibe_nome_categoria($conn, $idcategoria); ?>
                    <li class="breadcrumb-item text-uppercase">
                        <a id="breadcrumb" href="categoria?id=<?php //echo //$idproduto ?>"><?php //echo //$nomeproduto ?></a>
                    </li>
                    
                </ol>
            </nav>
            <h2 class="produtos-titulos mt-5 mb-5 ml-2"><?php echo strtoupper($nomecategoria); ?></h2>

            <div class="row">
                <?php while ($dados = pg_fetch_array($resultado)): ?>
                    <div class="col-12 col-sm-6 mb-5">
                        <div class="card" style="height:100%; border-radius: 2.25rem;">
                            <h5 class="card-title recentes"> <?php echo $dados['nomesubcategoria']; ?> </h5>
                            <div class="card-text categoria">

                                <span class="d-inline-block text-truncate" style="max-width: 100%;">
                                    <?php
                                    $idsubcategoria = $dados['id_subcategoria'];
                                    $sqlpergunta = "SELECT * FROM pergunta WHERE fk_id_subcategoria = $idsubcategoria and visivel = true";
                                    $resultadopergunta = pg_query($conn, $sqlpergunta);
                                    while ($dadospergunta = pg_fetch_array($resultadopergunta)): ?>
                                        <a href="#"
                                            class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><?php echo ($dadospergunta['pergunta']) ?></a><br>

                                    <?php endwhile; ?>

                                </span>
                            </div>
                            <a href="perguntas?id=<?php echo ($dados['id_subcategoria'])?>" class="btn btn-recentes">
                                Visualizar todas as perguntas da subcategoria
                            </a>

                        </div>
                    </div>
                <?php endwhile; ?>
            </div>


        </div>
    </div>
</body>

<footer>
    <?php include_once 'include/footer.php' ?>
</footer>

>>>>>>> 478127839adca7eb7893823a23e04b27c3bcfc5d
</html>