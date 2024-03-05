<?php 
  include_once 'include/ref.php';
  include_once 'php_action/db_connect.php';
  include_once 'php_action/DAOcategoria.php';
  $pagina = "categoria";
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
                $produto = $dados['nomeproduto']; 
                //filtro de respostas em branco
                $sql = "SELECT * FROM pergunta WHERE produto ilike '$nomeproduto' and resposta is not null";
                $resultado = pg_query($conn, $sql);
               
            ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-4">
                    <li class="breadcrumb-item"><a href="index.php">Início</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo strtoupper($nomeproduto);?></li>
                </ol>
            </nav>
            <h2 class="produtos-titulos mt-5 mb-5 ml-2"><?php echo strtoupper($nomeproduto); ?></h2>

            <div class="row">
                <?php   while($dados = pg_fetch_array($resultado)): ?>
                <div class="col-12 col-sm-6 mb-5">
                    <div class="card" style="height:100%; border-radius: 2.25rem;">
                        <h5 class="card-title recentes"> <?php echo $dados['pergunta']; ?> </h5>
                        <div class="card-text categoria">
                            <span class="d-inline-block text-truncate" style="max-width: 100%;">
                                <?php echo $dados['resposta']; ?>
                            </span>
                        </div>
                        <form method="POST" action="php_action/DAOcontagem.php?id=<?php echo $dados['id_pergunta']; ?>"
                            id="formRecentes">
                            <button type="submit" name="btnAcessos" class="btn btn-recentes">Visualizar
                                resposta completa</button>
                        </form>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>


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

<footer>
    <?php  include_once 'include/footer.php' ?>
</footer>

</html>