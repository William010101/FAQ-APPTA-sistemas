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
    <div class="row  ">
        <div class="col mx-auto col-lg-8">
            <h3 class="font-weight-light mt-1 mb-3"> Cadastro de Subcategoria</h3>
            <form name="form1" action="" method="POST">

                <div class="form-group">
                    <h6> <label class="mb-0" for="pergunta">Nome da subcategoria</label><br></h6>
                    <input class="border w-100 p-2" type="text" name="nomesubcategoria" id="nomesubcategoria"
                        placeholder="Titulo da categoria">

                </div>
                <h6> <label class="mb-0" for="pergunta">Nome da categoria relacionada</label><br></h6>
             
                <select  class="form-select" id="floatingSelect" aria-label="Floating label select example" name="fk_id_categoria" id="fk_id_categoria" >
                    <option selected>Selecione </option>
                    <?php
                        $categorias = $categoria->GetTodasCategorias();
                        foreach ($categorias as $cat):
                    ?>
                    <option value="<?php echo $cat->id_categoria; ?>"><?php echo $cat->nomecategoria; ?></option>
                    <?php endforeach; ?>
                </select>


                <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel" value="1">
                    <label class="custom-control-label" for="customControlValidation1">Mostrar subcategoria no site!</label>
                </div>



                <button type="submit" name="btn-cadastrarsubcategoria" class="btn btn-primary mt-4"> Cadastrar </button>
                <a href="categoria.php" class="btn btn-success mt-4" data-toggle="modal"
                    data-target="#confirmarsaidaproduto" id="voltar"> Voltar </a>
            </form>
            <h2 class="produtos-titulos mt-5 mb-0"> <?php echo $subcategoria->CadastrarSubategoria(); ?></h2>


        </div>
    </div>
</div>

<?php
// Footer
include_once 'includes/footer.php';
?>