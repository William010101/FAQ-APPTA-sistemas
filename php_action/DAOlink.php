<?php 

if(isset($_GET['id'])) {
    $id = pg_escape_string($conn, $_GET['id']);

    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
    }

    $id = limpar_texto($id);

    if($id == "") {
        header('Location: inicio');
    }

    $sql = "SELECT * FROM pergunta INNER JOIN produto ON pergunta.produto = produto.nomeproduto WHERE id_pergunta = '$id'";
    $resultado = pg_query($conn, $sql);
    $dados = pg_fetch_array($resultado);
    $rows = pg_num_rows($resultado);

    if($rows == 0) {
        header('Location: inicio');
    }

    $pergunta = $dados['pergunta']; 
    $resposta = $dados['resposta']; 
    $produto = $dados['produto'];
    $chave = $dados['chave'];
    $idproduto =  $dados['id_produto'];
    $subcategoria = $dados['subcategoria'];
    $numacessos = $dados['numacessos'];
    $usuario = $dados['usuario'];
    $idUsuario = $dados['idusuario'];
    $video = $dados['video'];
    $idpergunta =  $dados['id_pergunta'];

    //select usuario
    $sql = "SELECT * FROM usuarios WHERE id_usuario = $idUsuario";    
    $resultadofoto = pg_query($conn, $sql);
    $dadosPerfil = pg_fetch_array($resultadofoto);
    $fotoPerfil = $dadosPerfil['fotoperfil'];

    //select pergunta anterior
    $sql = "SELECT id_pergunta, pergunta FROM pergunta WHERE id_pergunta < '$idpergunta' ORDER BY id_pergunta DESC LIMIT 1";
    $resultadoAnterior = pg_query($conn, $sql);
    $dadosAnterior = pg_fetch_array($resultadoAnterior);
    $perguntaAnterior = isset($dadosAnterior['pergunta']) ? $dadosAnterior['pergunta'] : ''; 
    $idperguntaAnterior = isset($dadosAnterior['id_pergunta']) ? $dadosAnterior['id_pergunta'] : ''; 

    //select proxima pergunta
    $sql = "SELECT id_pergunta, pergunta FROM pergunta WHERE id_pergunta > '$idpergunta' ORDER BY id_pergunta ASC LIMIT 1";
    $resultadoProximo = pg_query($conn, $sql);
    $dadosProximo = pg_fetch_array($resultadoProximo);
    $perguntaProximo = isset($dadosProximo['pergunta']) ? $dadosProximo['pergunta'] : ''; 
    $idperguntaProximo = isset($dadosProximo['id_pergunta']) ? $dadosProximo['id_pergunta'] : ''; 

    //select perguntas relacionadas
    $sql = "SELECT * FROM pergunta WHERE chave iLIKE '%$chave%' LIMIT 8";
    $resultadoRelacionados = pg_query($conn, $sql); 
    $dadosRelacionados = [];
    while ($row = pg_fetch_assoc($resultadoRelacionados)) {
        $dadosRelacionados[] = $row;
    }

} else {
    header('Location: inicio');
}
?>
