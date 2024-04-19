

<?php
//require_once 'OBJconection.php';
class Subcategoria
{
    public int $id_subcategoria;
    public string $nomesubcategoria;
    public bool $visivel;
    private $Conexao;
    public function __construct(){
        $this->Conexao = new Conexao();
    }
    public function GetSubcategoriaDaCategoria($id_categoria)
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT id_subcategoria, nomesubcategoria FROM subcategoria where fk_id_categoria = :id_categoria AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Subcategoria');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}