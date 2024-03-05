<?php
session_start();
// Header

include_once 'includes/header.php';
?>

<link href="css/style.css" rel="stylesheet" media="screen">
<link href="css/mobile-style.css" rel="stylesheet" media="screen">

<div class="container">
    <div class="row">
        <div class="col offset-md-1 mt-4 col-lg-8">
            <h3 class="font-weight-light mt-1 mb-3"> Cadastro de Produto</h3>
            <form name="form1" action="php_action/create.php" method="POST">

                <div class="form-group">
                    <h6> <label class="mb-0" for="pergunta">Titulo</label><br></h6>
                    <input class="border w-100 p-2" type="text" name="nomeproduto" id="nomeproduto"
                        placeholder="Titulo do produto">

                </div>


                <div class="form-group">
                <h6> <label class="mb-0" for="pergunta">Categoria</label><br></h6>             
                    <select class="custom-select" id="categoria" name="categoria">
                        <option selected>Escolher...</option>
                        <option value="Primario">Primário</option>
                        <option value="Secundario">Secundário</option>
                    </select>
                </div>

                <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel">
                    <label class="custom-control-label" for="customControlValidation1">Mostrar produto no site!</label>
                </div>



                <button type="submit" name="btn-cadastrarproduto" class="btn btn-primary mt-4"> Cadastrar </button>
                <a href="produtos.php" class="btn btn-success mt-4" data-toggle="modal"
                    data-target="#confirmarsaidaproduto" id="voltar"> Voltar </a>
            </form>



        </div>
    </div>
</div>

<?php
// Footer
include_once 'includes/footer.php';
?>