<?php
   // Conexão com o banco de dados
   $conn = pg_connect("host=localhost dbname=postgres user=postgres password=masterkey");

if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}