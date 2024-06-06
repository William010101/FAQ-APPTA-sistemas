<?php
include_once 'include/ref.php';
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
    <!-- Cabeçalho site "-->
    <?php //include_once 'include/header.php';  ?>
    <!-- Menu Pesquisa -->
    <section class="home-header ">
        <div class="container " id="menupesquisa">
            <div class="botao">
                <div class="row ">
                    <img class="col-6 mt-4" src="img\appta.png" alt="" style=" width: 90px; height: 100px;">
                    <h3 class="appta-titulo text-uppercase mt-4 mb-0 col-6"><span class="Poppins">Como podemos</span> <br><span
                            class="PoppinsBold">ajudar?</span></h3>
                    <div class="col-6 mx-auto">

                        <div class="inputSearch">
                            <form method="POST" action="search">
                                <div class="input-group mb-3">
                                    <input type="search" class="form-control" name="pesquisar"
                                        placeholder="Tente buscar por tópicos ou palavras-chave" id="inputHeader">
                                    <div class="input-group-append">
                                        <button class="btn " id="btnpesquisarhome" name="btnpesquisar" type="text"><i class="material-icons"
                                                id="">search</i></button>
                                    </div>
                                </div>
                            </form>
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