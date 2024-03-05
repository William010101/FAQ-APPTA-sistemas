<?php
// Conexão com banco de dados

$conn = pg_connect("host=127.0.0.1 port=5432 dbname=FAQ user=postgres password=masterkey");

if (!$conn) {
    echo "Erro ao conectar ao banco de dados.\n";
    echo pg_last_error($conn);
    exit;
}



?>