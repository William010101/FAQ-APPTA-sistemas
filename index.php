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
    <section class="home-header ">
        <div class="container col-12" id="menupesquisa">
            <div class="botao">
                <div class="row  ">
                    <img class="col-6 mt-4" src="img\appta.png" alt="" style=" width: 90px; height: 100px;">
                    <h3 class="appta-titulo text-uppercase mt-4 mb-0 col-6"><span class="Poppins">Como podemos</span> <br><span class="PoppinsBold">ajudar?</span></h3>
                    <div class=" col-12 mx-auto col-md-10 col-sm-12 col-lg-8 row mt-3">

                        <div class="inputSearch col-12">
                            <form method="POST" action="search">
                                <div class="input-group mb-3 col-12">
                                    <input type="search" class="form-control w-75" name="pesquisar" placeholder="Tente buscar por tópicos ou palavras-chave" id="inputHeader">
                                    
                                        <button class="btn" id="btnpesquisarhome" name="btnpesquisar" type="text"><i class="material-icons" id="">search</i></button>
                                    
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