
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

    public function DeletarProduto()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-deletar-produto'])) {
                $this->id_produto = $_POST['id_produto'];
                $query = "DELETE FROM produto WHERE id_produto = :id_produto";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_produto', $this->id_produto, PDO::PARAM_INT);
                $stmt->execute();
            } 
        } catch (PDOException $e) {
            echo "Erro ao deletar o produto: " . $e->getMessage();
        }
    }
    public function SetProduto()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-editar-produto'])) {
                $this->nomeproduto = $_POST['nomeproduto'];
                $this->visivel = isset($_POST['visivel']) ? ($_POST['visivel'] == '1' ? true : false) : false;
                $this->id_produto = $_POST['id_produto'];
                if($this->visivel == 1){
                $query = "UPDATE produto SET nomeproduto =  :nomeproduto , visivel = :visivel WHERE id_produto = :id_produto";
                }else{
                $query= "UPDATE produto SET nomeproduto = :nomeproduto , visivel = :visivel WHERE id_produto = :id_produto";
                }
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_produto', $this->id_produto, PDO::PARAM_INT);
                $stmt->bindParam(':nomeproduto', $this->nomeproduto, PDO::PARAM_STR);
                $stmt->bindParam(':visivel', $this->visivel, PDO::PARAM_BOOL);
                $stmt->execute();
                echo "Produto alterado com sucesso!";
            } 
        } catch (PDOException $e) {
            echo "Erro ao alterar produto: " . $e->getMessage();
        }
    }

    public function CadastroProduto()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-cadastrarproduto'])) {
                $this->nomeproduto = $_POST['nomeproduto'];
                $this->visivel = $_POST['visivel'];
                $query = "INSERT INTO produto (nomeproduto, visivel) VALUES (:nomeproduto, :visivel)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':nomeproduto', $this->nomeproduto, PDO::PARAM_STR);
                $stmt->bindParam(':visivel', $this->visivel, PDO::PARAM_BOOL);
                $stmt->execute();
                echo "Produto inserido com sucesso!";
            } 
        } catch (PDOException $e) {
            echo "Erro ao inserir o produto: " . $e->getMessage();
        }
    }

    public function GetProduto($idproduto)
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

    public function GetTodosProdutos()
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM produto";//
            $stmt = $pdo->prepare($query);
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

            $query = "SELECT * FROM produto WHERE visivel = true";//
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Produto');
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}