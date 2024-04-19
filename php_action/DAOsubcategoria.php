<?php
 if(isset($_GET['id']) && isset($_GET['produto'])):
    $id = pg_escape_string($conn, $_GET['id']);
    $produto = $_GET['produto'];
    // Divida a string usando o hífen (-) como separador
    $produto_info = explode('-', $produto);
    // O primeiro elemento do array será o ID do produto
    $idproduto = $produto_info[0];
    $nomeproduto = $produto_info[1];
    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
      }

    $id= limpar_texto($id);
    
    if($id==""):
        header('Location: inicio');
    endif;
	$sql = "SELECT * FROM categoria WHERE id_categoria = '$id'";
	$resultado = pg_query($conn, $sql);
    $dados = pg_fetch_array($resultado);    
    else:
        header('Location: inicio');
    endif;

    $sql = "SELECT * FROM categoria where visivel = true ORDER BY
    id_categoria";
    $resultado = pg_query($conn, $sql);
    

    $nomecategoria = $dados['nomecategoria']; 
    $idcategoria = $dados['id_categoria'];
     
    ?>