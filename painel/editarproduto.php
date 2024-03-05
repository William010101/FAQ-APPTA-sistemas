<?php
    session_start();
    // Conexão
    include_once 'php_action/db_connect.php';
    // Header
    include_once 'includes/header.php';

    // Select
    if(isset($_GET['id'])):
        $id = pg_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM produto WHERE id_produto = '$id'";
        $resultado = pg_query($conn, $sql);
        $dados = pg_fetch_array($resultado);
    endif;

?>

<link href="css/style.css" rel="stylesheet" media="screen">
<link href="css/mobile-style.css" rel="stylesheet" media="screen">

<div class="container">
    <div class="row">
        <div class="col offset-md-1 mt-4 col-lg-8">

            <p class="h1 font-weight-light">Editar Produto</p>

            <form name="formulario" action="php_action/update.php" method="POST">

                <input type="hidden" name="id_produto" value="<?php echo $dados['id_produto'];?>">

                <div class="form-group">
                    <h6> <label class="mb-0" for="nomeproduto">Titulo</label> <br> </h6>
                    <input class="border w-100 p-2" type="text" name="nomeproduto" id="nomeproduto"
                    value="<?php echo $dados['nomeproduto']; ?>" placeholder="pergunta">
                         
                </div>

               

                <div class="form-group">
                <h6> <label class="mb-0" for="pergunta">Categoria</label><br></h6>             
                    <select class="custom-select" id="categoria" name="categoria">
                        <option selected><?php echo $dados['categoria']; ?></option>
                        <option value="Primario">Primário</option>
                        <option value="Secundario">Secundário</option>
                    </select>
                </div>

                <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel">
                    <label class="custom-control-label" for="customControlValidation1">Mostrar produto no site!</label>
                </div>
                
                <div class="mt-2">
                    <button type="submit" name="btn-editar-produto" class="btn btn-primary mb-4"> Atualizar</button>
                    <a href="produtos.php" class="btn btn-success mb-4" data-toggle="modal" data-target="#confirmarsaidaproduto">Lista de produtos</a>
                </div>
            </form>

        </div>
    </div>

</div>

<?php
// Footer
include_once 'includes/footer.php';
?>