
<?php
// function exibe_nome_prd($conn,$nomeproduto){
//     $sql = "SELECT id_produto, nomeproduto FROM produto WHERE nomeproduto = '$nomeproduto'";
//     $resultado = pg_query($conn, $sql);
//     $dados = pg_fetch_array($resultado);   
//     $nome = $dados['nomeproduto'];
//     $id = $dados['id_produto'];
//     $breadcrumb = '<li class="breadcrumb-item text-uppercase"><a id="breadcrumb" href="categoria?id='.$id.'">' .$nome. '</a></li>';
//     return $breadcrumb;
// }

// function exibe_nome_categoria($conn,$idcategoria){
//     $sql = "SELECT id_produto, nomeproduto , nomecategoria, id_categoria
//     FROM produto
//     INNER JOIN categoria ON id_produto = categoria.fk_id_produto
//     WHERE id_categoria = '$idcategoria'";
//     $resultado = pg_query($conn, $sql);
//     $dados = pg_fetch_array($resultado);
//     $nomeproduto = $dados['nomeproduto'];
//     $idproduto = $dados['id_produto'];
//     $nomecategoria = $dados['nomecategoria'];
//     $id_categoria = $dados['id_categoria'];
//     $breadcrumb = '<li class="breadcrumb-item text-uppercase"><a id="breadcrumb" href="categoria?id='.$idproduto.'">'.$nomeproduto. '</a></li>'.
//     '<li class="breadcrumb-item text-uppercase"><a id="breadcrumb" href="subcategoria?id='.$id_categoria.'">'.$nomecategoria. '</a></li>';
//     return $breadcrumb;
// }
?>



