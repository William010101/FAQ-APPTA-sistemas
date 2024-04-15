
<?php
function exibe_nome_prd($conn,$nomeproduto){
    $sql = "SELECT id_produto, nomeproduto FROM produto WHERE nomeproduto = '$nomeproduto'";
    $resultado = pg_query($conn, $sql);
    $dados = pg_fetch_array($resultado);   
    $nome = $dados['nomeproduto'];
    $id = $dados['id_produto'];
    $breadcrumb = '<li class="breadcrumb-item text-uppercase"><a id="breadcrumb" href="categoria?id='.$id.'">' .$nome. '</a></li>';
    return $breadcrumb;
}

function exibe_nome_categoria($conn,$nomecategoria){
        $sql = "SELECT id_categoria, nomecategoria FROM categoria WHERE nomeproduto = '$nomecategoria'";
        $resultado = pg_query($conn, $sql);
        $dados = pg_fetch_array($resultado);   
        $nome = $dados['nomeproduto'];
        $id = $dados['id_produto'];
        $breadcrumb = '<li class="breadcrumb-item text-uppercase"><a id="breadcrumb" href="categoria?id='.$id.'">' .$nome. '</a></li>';
        return $breadcrumb;
    }
?>



