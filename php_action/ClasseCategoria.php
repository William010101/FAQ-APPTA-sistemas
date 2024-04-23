

<?php
require_once 'ClasseConnection.php';

class Categoria
{
    public int $id_categoria;
    public string $nomecategoria;
    public bool $visivel;
    public int $fk_id_produto;
    private $Conexao;

    public function __construct(){
        $this->Conexao = new Conexao();
    }

    public function GetCategorias()
    {
        $idproduto = $_GET['id'];
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM categoria where fk_id_produto = :idProduto AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idProduto', $idproduto, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categoria');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function GetNomeCategoria($idcategoria)
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM categoria WHERE id_categoria = :idcategoria";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":idcategoria", $idcategoria, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categoria');
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}
