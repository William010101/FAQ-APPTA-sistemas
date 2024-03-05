<?php
 if(isset($_GET['id'])):
    $id = pg_escape_string($conn, $_GET['id']);
    if($id > 3){
        header('Location: inicio');
    }
    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
      }

    $id= limpar_texto($id);
    
    if($id==""):
        header('Location: inicio');
    endif;
	$sql = "SELECT * FROM produto WHERE id_produto = '$id'";
	$resultado = pg_query($conn, $sql);
    $dados = pg_fetch_array($resultado);    
    else:
        header('Location: inicio');
    endif;

    $sql = "SELECT * FROM produto where visivel = true ORDER BY
    id_produto";
    $resultado = pg_query($conn, $sql);  

    $nomeproduto = $dados['nomeproduto']; 
     
    ?>