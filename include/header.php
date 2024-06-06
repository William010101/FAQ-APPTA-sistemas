<?php 
  include_once 'include/ref.php';
//   include_once 'php_action/ClassePergunta.php';
//   $pergunta = new Pergunta();
//   $pergunta->Pesquisar();
?>

<div class="" id="navbar">
    <div class="container">

        <header class="header">
            <nav class="navbar navbar-light">
                <a class="navbar-brand" href="inicio" title="Página inicial">
                    <img src="img/logocentralajuda.svg" height="50" class="logocentral" alt="Logotipo">
                </a>
                <form method="POST" action="search" id="searchnav">
                    <div class="input-group" id="pesquisacategoria">
                        <input id="inputpesquisa" type="search" name="pesquisar" class="form-control"
                            placeholder="Tente buscar por tópicos ou palavras-chave">
                        <div class="input-group-append">
                            <button type="submit" class="btn " name="btnpesquisar" id="btnpesquisar" type="text"><i class="material-icons"
                                    id="">search</i></button>
                        </div>
                    </div>
                </form>
                <div class="nav-wrapper" title="Site APPTA Sistemas">

                    </div>
                </div>
            </nav>

        </header>

    </div>
</div>