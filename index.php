<?php 
  include_once 'include/ref.php';
  include_once 'php_action/db_connect.php';
  $pagina = "inicio";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APPTA Sistemas</title>
</head>

<body>
    <!-- Cabeçalho site -->
    <?php include_once 'include/header.php'; ?>
    <!-- Menu Pesquisa -->
    <section class="home-header">
        <div class="container-fluid">
            <div class="container" id="menupesquisa">
                <div class="botao">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="appta-titulo text-uppercase"><span class="Poppins">Como podemos</span> <br><span
                                    class="PoppinsBold">ajudar?</span></h3>
                            <span class="RobotoRegular" id="appta-subtitulo">Encontre as informações que você precisa
                                <br> sobre os sistemas APPTA.</span>
                            <div class="inputSearch">
                                <form method="POST" action="search">
                                    <div class="input-group mb-3">
                                        <input type="search" class="form-control" name="pesquisar"
                                            placeholder="Tente buscar por tópicos ou palavras-chave"
                                            id="inputHeader">
                                        <div class="input-group-append">
                                            <button class="btn " id="btnpesquisarhome" type="text"><i
                                                    class="material-icons" id="">search</i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6" id="colProdutos">
                            <div class="containerProdutos">
                                <div class="gridProdutos">
                                    <div class="cardProdutos rounded-circle">
                                        <img src="img/ajudaappta.png" id="produtoAppta" alt="Produto APPTA">
                                    </div>
                                    <a name="Food" id="btnAppta" class="btn btn-link" href="categoria?id=1"
                                        role="button">Ajuda APPTA</a>
                                </div>
                                <div class="gridProdutos">
                                    <div class="cardProdutos rounded-circle"> <img src="img/ajudaapptafood.png"
                                            id="produtoFood" alt="Produto APPTA">
                                    </div>
                                    <a name="Food" id="btnFood" class="btn btn-link" href="categoria?id=2"
                                        role="button">Ajuda APPTA Food</a>
                                </div>
                                <div class="gridProdutos">
                                    <div class="cardProdutos rounded-circle">
                                        <img src="img/ajudafidelizappta.png" id="produtoFidelizappta"
                                            alt="Produto APPTA">
                                    </div>
                                    <a name="Food" id="btnFood" class="btn btn-link" href="categoria?id=3"
                                        role="button">Ajuda FidelizAPPTA</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php include_once 'include/body.php' ?>
    <?php include_once 'include/footer.php' ?>
</body>



</html>