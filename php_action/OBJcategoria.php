<?php

class Categoria {

    private $pdo;
    public int $id_categoria;
    public string $nomecategoria;
    public bool $visivel;
    public int $fk_id_produto;

    public function conectar() {
        try {
            $this->pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=masterkey");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }

    public function consultarCategorias() {
        try {
            // Obter o ID do produto diretamente de $_GET
            $idproduto = $_GET['id'];
            
            // Conectar ao banco de dados
            $this->conectar();
            
            // Query para selecionar dados da tabela categorias
            $query = "SELECT id_categoria, nomecategoria FROM categoria where fk_id_produto = :idProduto AND visivel = true ";
            
            // Preparando e executando a query
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':idProduto', $idproduto, PDO::PARAM_INT);
            $stmt->execute();
            
            // Retornar todos os resultados como um array de objetos Categoria
            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Categoria');
        } catch (PDOException $e) {
            throw new PDOException($e);
        }
    }
    
    
    
}
?>
