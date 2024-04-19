<<<<<<< HEAD
<?php
require_once 'OBJconection.php';

class Categoria
{
    public int $id_categoria;
    public string $nomecategoria;
    private bool $visivel;
    private $Conexao;

    public function __construct(){
        $this->Conexao = new Conexao();
    }

    public function consultarCategorias()
    {
        $idproduto = $_GET['id'];
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT id_categoria, nomecategoria FROM categoria where fk_id_produto = :idProduto AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idProduto', $idproduto, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, 'Categoria');
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}
