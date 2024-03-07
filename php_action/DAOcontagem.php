<?php 

  include_once 'db_connect.php';

  //select para mostrar categorias no site
if(isset($_GET['id'])):
    $id = pg_escape_string($conn, $_GET['id']);
    if($id==""):
        header('Location: ../inicio');
    endif;
    $sql = "SELECT * FROM pergunta INNER JOIN produto ON pergunta.produto = produto.nomeproduto WHERE id_pergunta= '$id'";	
    $resultado = pg_query($conn, $sql);


    $dados = pg_fetch_array($resultado);

    $idpergunta = $dados['id_pergunta'];  
    $numacessos = $dados['numacessos'];
    
if(isset($_POST['btnAcessos'])):
    
	$sql = "UPDATE pergunta SET numacessos =  $numacessos + 1  WHERE
    id_pergunta = '$id'";

    pg_query($conn, $sql);
    //header("");
    header("Location: ../link?id=$idpergunta");
    
endif;


else:
    header('Location: ../inicio');
endif;
?>