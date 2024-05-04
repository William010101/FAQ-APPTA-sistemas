<?php
    session_start();
    include_once 'includes/header.php';
    include_once '../php_action/ClasseCategoria.php';
    include_once '../php_action/ClasseProduto.php';
    include_once '../php_action/ClasseConnection.php';
    $categoria = new Categoria();
    $produto = new Produto();

?>

<link href="css/style.css" rel="stylesheet" media="screen">
<link href="css/mobile-style.css" rel="stylesheet" media="screen">

<div class="container">
    <div class="row">
        <div class="col offset-md-1 mt-4 col-lg-8">

            <p class="h1 font-weight-light">Editar Categoria</p>

            <form name="formulario" action="" method="POST">
                    <?php
                        $categoria = $categoria->GetCategoria($_GET['id']);
                        foreach ($categoria as $cat):
                    ?>
                <input type="hidden" name="id_categoria" value="<?php echo $cat->id_categoria;?>">

                <div class="form-group">
                    <h6> <label class="mb-0" for="nomeproduto">Nome da categoria</label> <br> </h6>
                    <input class="border w-100 p-2" type="text" name="nomecategoria" id="nomecategoria"
                    value="<?php echo $cat->nomecategoria; ?>" placeholder="pergunta">
                         
                </div>

                <h6> <label class="mb-0" for="pergunta">Nome do produto relacionado</label><br></h6>
             
                <select  class="form-select" id="floatingSelect" aria-label="Floating label select example" name="fk_id_produto" id="fk_id_produto" >
                    
                    <?php
                        $produtos = $produto->GetProdutos();
                        foreach ($produtos as $prod):
                    ?>
                    <option value="<?php echo $prod->id_produto; ?>"><?php echo $prod->nomeproduto; ?></option>
                    <?php endforeach; ?>
                    <?php if($cat->fk_id_produto == $prod->id_produto):?>
                    <option selected value="<?php echo $prod->id_produto; ?>">                       
                            <?php echo $prod->nomeproduto;?> 
                    </option>
                    <?php endif?>
                </select>

                <?php if($cat->visivel == true):?>
                <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel" checked value='0'>
                    <label class="custom-control-label" for="customControlValidation1">Mostrar categoria no site!</label>
                </div>
                <?php else:?>
                    <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel" value='1'>
                    <label class="custom-control-label" for="customControlValidation1">Mostrar categoria no site!</label>
                </div>
                <?php endif; ?>
                <div class="mt-2">
                    <button type="submit" name="btn-editar-categoria" class="btn btn-primary mb-4"> Atualizar</button>
                    <a href="categoria.php" class="btn btn-success mb-4" data-toggle="modal" data-target="#confirmarsaidaproduto">Lista de categorias</a>
                </div>
                <?php endforeach;?> 
                <?php $cat->SetCategoria();?>
            </form>
           
        </div>
    </div>

</div>

<?php
// Footer
include_once 'includes/footer.php';
?>