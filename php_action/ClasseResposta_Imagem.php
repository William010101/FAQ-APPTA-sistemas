<?php
require_once 'ClasseConnection.php'; // Certifique-se de que o nome do arquivo da classe Conexao está correto

class Respostaimagem
{
    public int $id_respostaimagem;
    public int $ordem;
    public string $imagem;
    public string $descricao;
    public string $resposta;
    public int $fk_id_pergunta;
    private $Conexao;

    public function __construct(){
        $this->Conexao = new Conexao();
        $this->Conexao->conectar(); // Chame o método conectar() para estabelecer a conexão com o banco de dados
    }

    public function GetImagemResposta($id_pergunta)
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM resposta_imagem where fk_id_pergunta = :id_pergunta";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Respostaimagem');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}

?>