

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

    public function Deletarcategoria()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-deletar-categoria'])) {
                $this->id_categoria = $_POST['id_categoria'];
                $query = "DELETE FROM categoria WHERE id_categoria = :id_categoria";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
                $stmt->execute();
            } 
        } catch (PDOException $e) {
            echo "Erro ao deletar categoria: " . $e->getMessage();
        }
    }

    public function SetCategoria()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-editar-categoria'])) {
                $this->nomecategoria = $_POST['nomecategoria'];
                $this->fk_id_produto = $_POST['fk_id_produto'];
                $this->visivel = isset($_POST['visivel']) ? 1  : 0;
                $this->id_categoria = $_POST['id_categoria'];
                if($this->visivel == 1){
                $query = "UPDATE categoria SET nomecategoria =  :nomecategoria , visivel = :visivel , fk_id_produto = :fk_id_produto WHERE id_categoria = :id_categoria";
                }else{
                $query= "UPDATE categoria SET nomecategoria = :nomecategoria , visivel = :visivel , fk_id_produto = :fk_id_produto WHERE id_categoria = :id_categoria";
                }
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_categoria', $this->id_categoria, PDO::PARAM_INT);
                $stmt->bindParam(':nomecategoria', $this->nomecategoria, PDO::PARAM_STR);
                $stmt->bindParam(':fk_id_produto', $this->fk_id_produto, PDO::PARAM_INT);
                $stmt->bindParam(':visivel', $this->visivel, PDO::PARAM_BOOL);
                $stmt->execute();
                echo "Categoria alterada com sucesso!";
            } 
        } catch (PDOException $e) {
            echo "Erro ao alterar a categoria: " . $e->getMessage();
        }
    }

    public function CadastroCategoria()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-cadastrarcategoria'])) {
                $this->nomecategoria = $_POST['nomecategoria'];
                $this->fk_id_produto = $_POST['fk_id_produto'];
                $this->visivel = $_POST['visivel'];
                $query = "INSERT INTO categoria (nomecategoria, visivel, fk_id_produto) VALUES (:nomecategoria, :visivel, :fk_id_produto)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':nomecategoria', $this->nomecategoria, PDO::PARAM_STR);
                $stmt->bindParam(':visivel', $this->visivel, PDO::PARAM_BOOL);
                $stmt->bindParam(':fk_id_produto', $this->fk_id_produto, PDO::PARAM_INT);
                $stmt->execute();
                echo "Categoria inserida com sucesso!";
            } 
        } catch (PDOException $e) {
            echo "Erro ao inserir a categoria: " . $e->getMessage();
        }
    }

    public function GetCategorias($idproduto)
    {
         
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

    public function GetCategoria($idcategoria)
    {
         
        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT * FROM categoria where id_categoria = :idcategoria";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':idcategoria', $idcategoria, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categoria');
            return $stmt->fetchAll();
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
    }

    public function GetTodasCategorias()
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM categoria";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categoria');
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}
