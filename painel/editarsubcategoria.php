<?php
    session_start();
    include_once 'includes/header.php';
    include_once '../php_action/ClasseSubcategoria.php';
    include_once '../php_action/ClasseCategoria.php';
    include_once '../php_action/ClasseConnection.php';
    $subcategoria = new Subcategoria();
    $categoria = new Categoria();

?>

<link href="css/style.css" rel="stylesheet" media="screen">
<link href="css/mobile-style.css" rel="stylesheet" media="screen">

<div class="container">
    <div class="row">
        <div class="col offset-md-1 mt-4 col-lg-8">

            <p class="h1 font-weight-light">Editar Subcategoria</p>

            <form name="formulario" action="" method="POST">
                    <?php
                        $subcategorias = $subcategoria->GetSubcategoria($_GET['id']);
                        foreach ($subcategorias as $sub):
                    ?>
                <input type="hidden" name="id_subcategoria" value="<?php echo $sub->id_subcategoria;?>">

                <div class="form-group">
                    <h6> <label class="mb-0" for="nomeproduto">Nome da subcategoria</label> <br> </h6>
                    <input class="border w-100 p-2" type="text" name="nomesubcategoria" id="nomesubcategoria"
                    value="<?php echo $sub->nomesubcategoria; ?>" placeholder="pergunta">
                         
                </div>

                <h6> <label class="mb-0" for="pergunta">Nome da categoria relacionada</label><br></h6>
             
                <select  class="form-select" id="floatingSelect" aria-label="Floating label select example" name="fk_id_categoria" id="fk_id_categoria" >
                    
                    <?php
                        $categorias = $categoria->GetTodasCategorias();
                        foreach ($categorias as $cat):
                    ?>
                    <?php if($sub->fk_id_categoria == $cat->id_categoria):?>
                    <option selected value="<?php echo  $cat->id_categoria; ?>">                       
                            <?php echo  $cat->nomecategoria;?> 
                    </option>
                    <?php endif?>
                    <option value="<?php echo $cat->id_categoria; ?>"><?php echo  $cat->nomecategoria; ?></option>
                    <?php endforeach; ?>
                    
                </select>

                <?php if($sub->visivel == true):?>
                    <div class="custom-control custom-checkbox mt-4">
                        <input type="checkbox" class="custom-control-input" checked id="customControlValidation1" name="visivel">
                            <label class="custom-control-label" for="customControlValidation1">Exibir subcategoria no site?</label>
                            </div>
                <?php else: ?>
                            <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel">
                            <label class="custom-control-label" for="customControlValidation1">Exibir subcategoria no site?</label>
                            </div>
                <?php endif; ?>
                <div class="mt-2">
                    <button type="submit" name="btn-editar-subcategoria" class="btn btn-primary mb-4"> Atualizar</button>
                    <a href="subcategoria.php" class="btn btn-success mb-4" data-toggle="modal" data-target="#confirmarsaidasubcategoria">Lista de subcategorias</a>
                </div>
                <?php endforeach;?> 
                <h2 class="produtos-titulos mt-5 mb-0"><?php $sub->SetSubcategoria();?></h2>
            </form>
           
        </div>
    </div>

</div>

<?php
// Footer
include_once 'includes/footer.php';
?>