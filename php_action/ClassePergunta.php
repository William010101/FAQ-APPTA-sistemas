

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

    public function GetPerguntas($fk_id_subcategoria)
    {
        
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM pergunta where fk_id_subcategoria = :fk_id_subcategoria AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':fk_id_subcategoria', $fk_id_subcategoria, PDO::PARAM_INT);
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

}
