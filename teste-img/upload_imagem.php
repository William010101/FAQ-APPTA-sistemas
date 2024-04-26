<?php
// upload_imagem.php
require_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    // Conectar ao banco de dados
    $conn = pg_connect("host=localhost dbname=postgres user=postgres password=masterkey");
    
    if (!$conn) {
        echo "Erro ao conectar ao banco de dados.";
        exit;
    }

    // Ler a imagem do arquivo enviado
    $imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);

    // Escapar a imagem para ser inserida no banco de dados
    $imagem_escapada = pg_escape_bytea($imagem);
    

    // Preparar a consulta SQL com um placeholder para a imagem
    $query = "INSERT INTO resposta_imagem (id_respostaimagem, ordem, imagem, descricao, resposta, fk_id_pergunta) VALUES (2, default, $1, 'dsnfjnsdfn', 'kdsnjfnjasndf', 1)";
    
    // Executar a consulta com os parâmetros
    $result = pg_query_params($conn, $query, array($imagem_escapada));

    if ($result) {
        echo "Imagem enviada com sucesso.";
    } else {
        echo "Erro ao enviar imagem.";
    }

    // Fechar a conexão com o banco de dados
    pg_close($conn);
}
?>

?>

<form method="post" enctype="multipart/form-data">
    Selecione uma imagem:
    <input type="file" name="imagem">
    <input type="submit" value="Enviar">
    
</form>
