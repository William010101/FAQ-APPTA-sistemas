<?php
// Conexão com banco de dados

$conn = pg_connect("host=localhost port=5432 dbname=FAQ user=postgres password=123");

if (!$conn) {
    echo "Erro ao conectar ao banco de dados.\n";
    echo pg_last_error($conn);
    exit;
}



?>