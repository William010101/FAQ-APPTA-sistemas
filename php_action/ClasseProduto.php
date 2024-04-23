
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
    public function GetNomeProduto($idproduto)
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM produto WHERE id_produto = :idproduto";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":idproduto", $idproduto, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Produto');
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function GetProdutos()
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM produto WHERE visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Produto');
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}