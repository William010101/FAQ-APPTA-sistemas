<?php
session_start();
include_once 'includes/header.php';
include_once 'services/ProdutoService.php';
include_once '../php_action/ClasseConnection.php';
$service = new ProdutoService();

?>

<link href="css/style.css" rel="stylesheet" media="screen">
<link href="css/mobile-style.css" rel="stylesheet" media="screen">

<div class="container">
    <div class="row  ">
        <div class="col mx-auto col-lg-8">
            <h3 class="font-weight-light mt-1 mb-3"> Cadastro de Produto</h3>
            <form name="form1" action="" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <h6> <label class="mb-0" for="pergunta">Nome do Produto</label><br></h6>
                    <input class="border w-100 p-2" type="text" name="nomeproduto" id="nomeproduto"
                        placeholder="Titulo do produto">

                </div>
                <input class="form-control form-control-sm mb-3" id="formFileSm" type="file" name="imagem" id="imagem">
                <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel" value="1">
                    <label class="custom-control-label" for="customControlValidation1">Mostrar produto no site!</label>
                </div>



                <button type="submit" name="btn-cadastrarproduto" class="btn btn-primary mt-4"> Cadastrar </button>
                <a href="produtos.php" class="btn btn-success mt-4" data-toggle="modal"
                    data-target="#confirmarsaidaproduto" id="voltar"> Voltar </a>
            </form>
            <h2 class="produtos-titulos mt-5 mb-0"> <?php echo $service->PostProduto();?></h2>


        </div>
    </div>
</div>

<?php
// Footer
include_once 'includes/footer.php';
?>