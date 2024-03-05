<?php

//select para mostrar categorias no site
$sql = "SELECT * FROM produto where visivel =true ORDER BY
id_produto";
$resultado = pg_query($conn, $sql); 
$dados = pg_fetch_array($resultado); 

$nomeproduto = $dados['nomeproduto']; 

//select responsavel pela filtragem da pesquisa
$pesquisar = $_POST['pesquisar'];

$selectpesquisa = "SELECT * FROM pergunta, (select COUNT(*) from pergunta WHERE resposta iLIKE '%$pesquisar%' or subcategoria = '$pesquisar')  as total 
WHERE resposta iLIKE '%$pesquisar%' or subcategoria = '$pesquisar' order by id_pergunta is not null";
$resultadopesquisa = pg_query($conn, $selectpesquisa);


$valorcontagem = pg_query($conn, $selectpesquisa);
$contagem = pg_fetch_array($valorcontagem); 
$modal = pg_query($conn, $selectpesquisa);

//função para mostrar resposta resumida da pergunta ao pesquisar

function limita_caracteres($texto, $limite, $quebra = true){
$tamanho = strlen($texto);
if($tamanho <= $limite){ //Verifica se o tamanho do texto é menor ou igual ao limite
  $novo_texto = $texto;
}else{ // Se o tamanho do texto for maior que o limite
  if($quebra == true){ // Verifica a opção de quebrar o texto
     $novo_texto = trim(substr($texto, 0, $limite))."...";
  }else{ // Se não, corta $texto na última palavra antes do limite
     $ultimo_espaco = strrpos(substr($texto, 0, $limite), " "); // Localiza o útlimo espaço antes de $limite
     $novo_texto = trim(substr($texto, 0, $ultimo_espaco))."..."; // Corta o $texto até a posição localizada
  }
}
return $novo_texto; // Retorna o valor formatado
}



?>