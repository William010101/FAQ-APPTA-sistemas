
<?php
class Subcategoria
{
    public int $id_subcategoria;
    public string $nomesubcategoria;
    public bool $visivel;
    public int $fk_id_categoria;
    private $Conexao;

    public function __construct(){
        $this->Conexao = new Conexao();
    }


    public function SetSubcategoria()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-editar-subcategoria'])) {
                $this->nomesubcategoria = $_POST['nomesubcategoria'];
                $this->fk_id_categoria = $_POST['fk_id_categoria'];
                $this->visivel = isset($_POST['visivel']) ? 1  : 0;
                $this->id_subcategoria = $_POST['id_subcategoria'];
                if($this->visivel == 1){
                $query = "UPDATE subcategoria SET nomesubcategoria =  :nomesubcategoria , visivel = :visivel , fk_id_categoria = :fk_id_categoria WHERE id_subcategoria = :id_subcategoria";
                }else{
                $query= "UPDATE subcategoria SET nomesubcategoria = :nomesubcategoria , visivel = :visivel , fk_id_categoria = :fk_id_categoria WHERE id_subcategoria = :id_subcategoria";
                }
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_subcategoria', $this->id_subcategoria, PDO::PARAM_INT);
                $stmt->bindParam(':nomesubcategoria', $this->nomesubcategoria, PDO::PARAM_STR);
                $stmt->bindParam(':fk_id_categoria', $this->fk_id_categoria, PDO::PARAM_INT);
                $stmt->bindParam(':visivel', $this->visivel, PDO::PARAM_BOOL);
                $stmt->execute();
                echo "Subcategoria alterada com sucesso!";
                echo "<script>
                window.location.href = 'subcategoria.php';
                </script>";
            } 
        } catch (PDOException $e) {
            echo "Erro ao alterar a categoria: " . $e->getMessage();
        }
    }
    public function CadastrarSubCategoria()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-cadastrarsubcategoria'])) {
                $this->nomesubcategoria = $_POST['nomesubcategoria'];
                $this->fk_id_categoria = $_POST['fk_id_categoria'];
                $this->visivel = $_POST['visivel'];
                $query = "INSERT INTO subcategoria (nomesubcategoria, visivel, fk_id_categoria) VALUES (:nomesubcategoria, :visivel, :fk_id_categoria)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':nomesubcategoria', $this->nomesubcategoria, PDO::PARAM_STR);
                $stmt->bindParam(':visivel', $this->visivel, PDO::PARAM_BOOL);
                $stmt->bindParam(':fk_id_categoria', $this->fk_id_categoria, PDO::PARAM_INT);
                $stmt->execute();
                echo "Subcategoria inserida com sucesso!";
                echo "<script>
                window.location.href = 'subcategoria.php';
                </script>";
            } 
        } catch (PDOException $e) {
            echo "Erro ao inserir a categoria: " . $e->getMessage();
        }
    }
    public function DeletarSubcategoria()
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if(isset($_POST['btn-deletar-subcategoria'])) {
                $this->id_subcategoria = $_POST['id_subcategoria'];
                $query = "DELETE FROM subcategoria WHERE id_subcategoria = :id_subcategoria";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_subcategoria', $this->id_subcategoria, PDO::PARAM_INT);
                $stmt->execute();
            } 
        } catch (PDOException $e) {
            echo "Erro ao deletar subcategoria: " . $e->getMessage();
        }
    }

    public function GetTodasSubcategorias()
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM subcategoria";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'subcategoria');
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    public function GetTodasSubcategoriasVisiveis()
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM subcategoria where visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'subcategoria');
            return $stmt->fetchALL();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
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

    public function GetSubcategoria($id_subcategoria)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT * FROM subcategoria where id_subcategoria = :id_subcategoria";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_subcategoria', $id_subcategoria, PDO::PARAM_INT);
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
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}