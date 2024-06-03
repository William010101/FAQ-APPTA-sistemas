
<?php
class Produto
{
    public int $id_produto;
    public string $nomeproduto;

    public string $imagem;
    public bool $visivel; 
    private $Conexao;

    public function __construct(int $id_produto = 0, string $nomeproduto = "", string $imagem = "", bool $visivel = false)
    {
        $this->id_produto = $id_produto;
        $this->nomeproduto = $nomeproduto;
        $this->imagem = $imagem; 
        $this->visivel = $visivel;

         $this->Conexao = new Conexao();
         $this->Conexao->conectar();
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
    public function SetProduto(Produto $produto) 
    {
        try {
            $pdo = $this->Conexao->getPdo();
                if($this->visivel == 1){
                $query = "UPDATE produto SET nomeproduto =  :nomeproduto, imagem = :imagem, visivel = :visivel WHERE  id_produto = :id_produto"; //+ $clausulaWhere
                }else{
                $query= "UPDATE produto SET nomeproduto = :nomeproduto, imagem = :imagem, visivel = :visivel WHERE id_produto = :id_produto";
                }
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_produto', $produto->id_produto, PDO::PARAM_INT);
                $stmt->bindParam(':nomeproduto', $produto->nomeproduto, PDO::PARAM_STR);
                $stmt->bindValue(':imagem', $produto->imagem, PDO::PARAM_LOB);
                $stmt->bindParam(':visivel', $produto->visivel, PDO::PARAM_BOOL);
                $stmt->execute();
                return "Produto alterado com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao alterar produto: " . $e->getMessage();
        }
    }

    public function CadastroProduto(Produto $produto)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            
                $query = "INSERT INTO produto (nomeproduto, imagem, visivel) VALUES (:nomeproduto, :imagem, :visivel)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':nomeproduto', $produto->nomeproduto, PDO::PARAM_STR);
                $stmt->bindValue(':imagem', $produto->imagem, PDO::PARAM_LOB);
                $stmt->bindParam(':visivel', $produto->visivel, PDO::PARAM_BOOL);
                $stmt->execute();
                return "Produto inserido com sucesso!"; 
        } catch (PDOException $e) {
            return "Erro ao inserir o produto: " . $e->getMessage();
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
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $produtos = [];
            foreach ($results as $row) {
            $produto = new Produto();
            $produto->id_produto = $row['id_produto'];
            $produto->nomeproduto = $row['nomeproduto'];
            $produto->visivel = $row['visivel'];
            $produto->imagem = stream_get_contents($row['imagem']);
            $produtos[] = $produto;
        }
            return $produtos;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function GetTodosProdutos()
{
    try {
        $pdo = $this->Conexao->getPdo();

        $query = "SELECT * FROM produto";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $produtos = [];
        foreach ($results as $row) {
            $produto = new Produto();
            $produto->id_produto = $row['id_produto'];
            $produto->nomeproduto = $row['nomeproduto'];
            $produto->visivel = $row['visivel'];
            $produtos[] = $produto;
        }

        return $produtos;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}

public function GetProdutos()
{
    try {
        $pdo = $this->Conexao->getPdo();

        $query = "SELECT id_produto, nomeproduto, imagem FROM produto WHERE visivel = true";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $produtos = [];
        foreach ($results as $row) {
            $produto = new Produto();
            $produto->id_produto = $row['id_produto'];
            $produto->nomeproduto = $row['nomeproduto'];
            $produto->imagem = stream_get_contents($row['imagem']);
            $produtos[] = $produto;
        }
        
        return $produtos;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}


}