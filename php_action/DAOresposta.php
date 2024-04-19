<?php 

if(isset($_GET['id'])&& isset($_GET['produto'])&& isset($_GET['categoria'])&& isset($_GET['subcategoria'])) {
    $id = pg_escape_string($conn, $_GET['id']);
    //parte que pega as informações do produto
    $produto = $_GET['produto'];
    $produto_info = explode('-', $produto);
    $idproduto = $produto_info[0];
    $nomeproduto = $produto_info[1];

    //parte que pega as informações da categoria
    $categoria = $_GET['categoria'];
    $categoria_info = explode('-', $categoria);
    $idcategoria = $categoria_info[0];
    $nomecategoria = $categoria_info[1];

    //parte que pega as informações da subcategoria
    $subcategoria = $_GET['subcategoria'];
    $subcategoria_info = explode('-', $subcategoria);
    $idsubcategoria = $subcategoria_info[0];
    $nomesubcategoria = $subcategoria_info[1];
    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
    }

    $id = limpar_texto($id);

    if($id == "") {
        header('Location: inicio');
    }

    $sql = "SELECT * FROM pergunta WHERE id_pergunta = '$id'";
    $resultado = pg_query($conn, $sql);
    $dados = pg_fetch_array($resultado);
    $rows = pg_num_rows($resultado);

    if($rows == 0) {
        header('Location: inicio');
    }

    $pergunta = $dados['pergunta']; 
    $resposta = $dados['resposta']; 
    $usuario = $dados['usuario'];
    $idUsuario = $dados['idusuario'];
    $video = $dados['video'];
    $idpergunta =  $dados['id_pergunta'];

    //select usuario
    $sql = "SELECT * FROM usuarios WHERE id_usuario = $idUsuario";    
    $resultadofoto = pg_query($conn, $sql);
    $dadosPerfil = pg_fetch_array($resultadofoto);
    $fotoPerfil = $dadosPerfil['fotoperfil'];

} else {
    header('Location: inicio');
}
?>
