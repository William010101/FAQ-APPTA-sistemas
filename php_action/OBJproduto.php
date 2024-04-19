<<<<<<< HEAD
<?php
class Produto
{
    public int $id_produto;
    public string $nomeproduto;

    public bool $visivel; 
    private $Conexao;

    public function __construct(){
        $this->Conexao = new Conexao();
    }
    public function exibeNomeProduto()
    {
        
        $idproduto = $_GET['id'];

        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT id_produto, nomeproduto FROM produto WHERE id_produto = :idproduto";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":idproduto", $idproduto, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
