<?php
    session_start();
    include_once 'includes/header.php';
    include_once '../php_action/ClasseProduto.php';
    include_once '../php_action/ClasseConnection.php';
    $produto = new Produto();

?>

<link href="css/style.css" rel="stylesheet" media="screen">
<link href="css/mobile-style.css" rel="stylesheet" media="screen">

<div class="container">
    <div class="row">
        <div class="col offset-md-1 mt-4 col-lg-8">

            <p class="h1 font-weight-light">Editar Produto</p>

            <form name="formulario" action="" method="POST">
                    <?php
                        $produtos = $produto->GetProduto($_GET['id']);
                        foreach ($produtos as $prod):
                    ?>
                <input type="hidden" name="id_produto" value="<?php echo $prod->id_produto;?>">

                <div class="form-group">
                    <h6> <label class="mb-0" for="nomeproduto">Nome do produto</label> <br> </h6>
                    <input class="border w-100 p-2" type="text" name="nomeproduto" id="nomeproduto"
                    value="<?php echo $prod->nomeproduto; ?>" placeholder="pergunta">
                         
                </div>
                <?php if($prod->visivel == true):?>
                <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel" checked value='0'>
                    <label class="custom-control-label" for="customControlValidation1">Mostrar produto no site!</label>
                </div>
                <?php else:?>
                    <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel" value='1'>
                    <label class="custom-control-label" for="customControlValidation1">Mostrar produto no site!</label>
                </div>
                <?php endif; ?>
                <div class="mt-2">
                    <button type="submit" name="btn-editar-produto" class="btn btn-primary mb-4"> Atualizar</button>
                    <a href="produtos.php" class="btn btn-success mb-4" data-toggle="modal" data-target="#confirmarsaidaproduto">Lista de produtos</a>
                </div>
                <?php endforeach;?>
            </form>
            <?php $prod->SetProduto();?>
        </div>
    </div>

</div>

<?php
// Footer
include_once 'includes/footer.php';
?>