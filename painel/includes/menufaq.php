<?php
// Conexão
include_once 'php_action/db_connect.php';
include_once 'includes/ref.php';
// if(!empty($_SESSION['id_usuario'])){
// 	//verifica se o login foi feito e permanece na pagina
// }else{
// 	header("Location: index.php");	
// }
?>

<div class="container-fluid bg-light">
    <div class="container">

        <header class="header">
            <nav class="navbar navbar-light ml-5">
                <div class="btn-group trocar">
                    <button class="btn  dropdown-toggle btn-lg text-dark ml-5" type="button" id="botao"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        TROCAR LISTA

                    </button>


                    <a href="../index.php" class="btn btn-light mt-1">Ir ao site </a>

                    <div class="dropdown-menu ml-5" aria-labelledby="dropdownMenuButton" id="submenudrop">

                        <a class="dropdown-item" href="produtos.php">Lista de Produtos</a>
                        <a class="dropdown-item" href="categoria.php">Lista de Categorias</a>
                        <a class="dropdown-item" href="subcategoria.php">Lista de Subcategorias</a>
                        <a class="dropdown-item" href="perguntas.php">Lista de Perguntas</a>

                    </div>

                </div>
                <!-- <div class="nav-wrapper" title="Site APPTA Sistemas">
                <label class="text-uppercase h5 mr-2"> <?php    $usuario = 1;
                        //$sql = "SELECT * FROM usuarios where id_usuario ='$usuario'";
                       // $resultado = pg_query($conn, $sql);
                        //$dados = pg_fetch_array($resultado); ?>
                        Olá, 
                        <?php //echo $dados['nome'];?> </label>
                
                </div> -->
            </nav>

        </header>

    </div>
</div>