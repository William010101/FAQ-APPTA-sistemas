<?php

function conectarBancoDeDados() {
    $conn = null;
    try {
        // Conexão com banco de dados
        $conn = pg_connect("host=localhost port=5432 dbname=FAQ user=postgres password=masterkey");

        if (!$conn) {
            throw new Exception("Erro ao conectar ao banco de dados: " . pg_last_error());
        }

        return $conn;
    } catch (Exception $e) {
        // Tratamento de erro
        echo "Ocorreu um erro: " . $e->getMessage();
        exit;
    }
}

// Chamada da função de conexão
$conn = conectarBancoDeDados();

// O código pode continuar a partir daqui usando a conexão $conn
?>