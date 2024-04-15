<?php
include_once 'include/ref.php';
include_once 'php_action/db_connect.php';
include_once 'php_action/DAOperguntas.php';
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
            $sql = "SELECT * FROM pergunta WHERE $idsubcategoria  = fk_id_subcategoria and visivel = true";
            $resultado = pg_query($conn, $sql);
            ?>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-4">
                    <li class="breadcrumb-item active" aria-current="page"><?php echo strtoupper($nomesubcategoria); ?>
                    </li>
                </ol>
            </nav>
            <h2 class="produtos-titulos mt-5 mb-5 ml-2"><?php echo strtoupper($nomesubcategoria); ?></h2>

            <div class="row">
                <?php while ($dados = pg_fetch_array($resultado)): ?>
                    <div class="col-12 col-sm-12 mb-5">
                        <div class="card">
                            <div class="card-header text-white">
                                <?php echo $dados['pergunta']; ?>
                            </div>
                            <div class="card-body p-2">
                                <p class="card-text">
                                    <?php
                                    $texto = $dados['resposta'];
                                    // Verifica se o comprimento da resposta é maior que 342
                                    if (strlen($texto) > 401) {
                                        // Se for, corta a resposta para 342 caracteres
                                        $texto = substr($texto, 0, 401);
                                        // Adiciona reticências para indicar que a resposta foi cortada
                                        $texto .= "...";
                                    }
                                    echo $texto;
                                    ?>
                                </p>

                                <a href="link?id=<?php echo $dados['id_pergunta']?>" class="btn-listar mt-2 ">visualizar resposta completa</a>
                            </div>
                        </div>
                        <!-- <div class="card" style="height:100%; border-radius: 2.25rem;">
                        <h5 class="card-title recentes">  </h5>
                        <div class="card-text categoria">

                            <span class="d-inline-block text-truncate" style="max-width: 100%;">
                            <?php
                            // $idsubcategoria = $dados['id_pergunta'];
                            // $sqlpergunta = "SELECT * FROM pergunta WHERE fk_id_subcategoria = $idsubcategoria and visivel = true";
                            // $resultadopergunta = pg_query($conn, $sqlpergunta);
                            //while ($dadospergunta = pg_fetch_array($resultadopergunta)): ?>
                                    <a href="#" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><?php echo ($dadospergunta['pergunta']) ?></a><br>
                                                            
                            <?php //endwhile; ?>
                      
                            </span>
                        </div>
                        <a href="link?id=<?php //echo ($dadossubcategoria['id_subcategoria']) ?>">  
                        <button type="submit" name="btnAcessos" class="btn btn-recentes">Visualizar todas as perguntas da subcategoria</button> </a>
                        
                    </div> -->
                    </div>
                <?php endwhile; ?>
            </div>


        </div>
    </div>

</body>

<footer>
    <?php include_once 'include/footer.php' ?>
</footer>

</html>