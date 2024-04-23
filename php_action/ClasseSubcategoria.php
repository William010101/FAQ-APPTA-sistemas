
<?php
class Subcategoria
{
    public int $id_subcategoria;
    public string $nomesubcategoria;
    public bool $visivel;
    private $Conexao;
    public function __construct(){
        $this->Conexao = new Conexao();
    }
    public function GetSubcategorias($id_categoria)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT * FROM subcategoria where fk_id_categoria = :id_categoria AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Subcategoria');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function BreadCrumbSubcategoria($id_categoria)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT id_produto, nomeproduto , id_categoria, nomecategoria
            FROM produto
            INNER JOIN categoria ON id_produto = categoria.fk_id_produto
            WHERE id_categoria = :id_categoria";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
             //$stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}