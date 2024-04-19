<<<<<<< HEAD
<?php
 if(isset($_GET['id'])&& isset($_GET['produto'])&& isset($_GET['categoria'])):
    //parte que pega as informações do produto
    $id = pg_escape_string($conn, $_GET['id']);
    $produto = $_GET['produto'];
    $produto_info = explode('-', $produto);
    $idproduto = $produto_info[0];
    $nomeproduto = $produto_info[1];

    //parte que pega as informações da categoria
    $categoria = $_GET['categoria'];
    $categoria_info = explode('-', $categoria);
    $idcategoria = $categoria_info[0];
    $nomecategoria = $categoria_info[1];
    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
      }

    $id= limpar_texto($id);
    
    if($id==""):
        header('Location: inicio');
    endif;
	$sql = "SELECT * FROM subcategoria WHERE id_subcategoria = '$id'";
	$resultado = pg_query($conn, $sql);
    $dados = pg_fetch_array($resultado);    
    else:
        header('Location: inicio');
    endif;

    $sql = "SELECT * FROM subcategoria where visivel = true ORDER BY
    id_subcategoria";
    $resultado = pg_query($conn, $sql);
    

    $nomesubcategoria = $dados['nomesubcategoria']; 
    $idsubcategoria = $dados['id_subcategoria'];
     
