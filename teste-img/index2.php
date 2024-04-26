<?php
    // exibir_imagem.php
    
    require_once ("db.php");


    $id = 1;

    $query = "SELECT imagem FROM imagens";
    $result = pg_query($conn, $query);

    if ($result) {
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            $imagem_binaria = pg_unescape_bytea($row['imagem']);

            // Definir o tipo de conteúdo como imagem
            //header("Content-type: image/png"); // Ou outro tipo de imagem, dependendo do formato
            //echo $imagem_binaria;
        } else {
            header("HTTP/1.0 404 Not Found");
            echo "Imagem não encontrada.";
        }
    } else {
        echo "Erro ao buscar imagem.";
    }
    ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibir Imagem</title>
</head>

<body>
    <h1>Exibindo Imagem</h1>
    <p>Aqui está a imagem:</p>

    <img style="width: 50px; height: 50px"> </img>
    <?php header("Content-type: image/png"); // Ou outro tipo de imagem, dependendo do formato
          // echo $imagem_binaria;?>
   
</body>

</html>