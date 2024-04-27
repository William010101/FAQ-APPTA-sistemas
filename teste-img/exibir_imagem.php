<!DOCTYPE html>
<html>
<head>
    <title>Exibir Imagem</title>
</head>
<body>

<?php
   require_once("db.php"); 
   $query = "SELECT imagem FROM resposta_imagem where id_respostaimagem = 1"; // Use o ID da imagem desejada
   $result = pg_query($conn, $query);
   
   if ($result) {
       if (pg_num_rows($result) > 0) {
           $row = pg_fetch_assoc($result);
           
           $imagem_binaria = pg_unescape_bytea($row['imagem']);
        //    function dataURI($imagem_binaria)
        //     {
               
                $img = 'data: image/png;base64,'.$imagem_binaria;
                //echo '<img src="data:image/png;base64,' . $imagem_binaria . '" alt="Descrição da imagem">';
            // }	
       } else {
           header("HTTP/1.0 404 Not Found");
           echo "Imagem não encontrada.";
       }
   } else {
       echo "Erro ao buscar imagem.";
   }
?>
<?php
// $img = dataURI($imagem_binaria);
?>
<img src="<?php echo $img ?>" style="width:300px; margin-top: 100px;"  alt="Imagem">

</body>
</html>
