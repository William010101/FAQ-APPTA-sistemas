

<?php
require_once 'ClasseConnection.php';

class Pergunta
{
    public int $id_pergunta;
    public string $pergunta;
    public string $resposta;
    public string $datacadastro;
    public string $video;
    public string $usuario;
    public int $idusuario;
    public bool $visivel;
    public int $fk_id_subcategoria;
    private $Conexao;

    public function __construct(){
        $this->Conexao = new Conexao();
    }

    public function GetPerguntas($id_subcategoria)
    {
        
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM pergunta where fk_id_subcategoria = :id_subcategoria AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_subcategoria', $id_subcategoria, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pergunta');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function GetResposta($id_pergunta)
    {
        
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM pergunta where id_pergunta = :id_pergunta AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pergunta');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function BreadCrumbPergunta($id_subcategoria)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT id_produto, nomeproduto , id_categoria, nomecategoria, id_subcategoria, nomesubcategoria
            FROM produto
            INNER JOIN categoria ON id_produto = categoria.fk_id_produto
            INNER JOIN subcategoria ON id_categoria = subcategoria.fk_id_categoria
            WHERE id_subcategoria = :id_subcategoria";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_subcategoria', $id_subcategoria, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    public function BreadCrumbReposta($id_pergunta)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT id_produto, nomeproduto , id_categoria, nomecategoria, id_subcategoria, nomesubcategoria, id_pergunta, pergunta
            FROM produto
            INNER JOIN categoria ON id_produto = categoria.fk_id_produto
            INNER JOIN subcategoria ON id_categoria = subcategoria.fk_id_categoria
            INNER JOIN pergunta ON id_subcategoria = pergunta.fk_id_subcategoria
            WHERE id_pergunta = :id_pergunta";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function Pesquisa(){
        $pesquisar = $_POST['pesquisar'];
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM pergunta where pergunta iLIKE '%$pesquisar%' OR resposta iLIKE '%$pesquisar%'  AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pergunta');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

}
