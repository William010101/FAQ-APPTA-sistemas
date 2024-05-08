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

    public function __construct(int $id_respostaimagem = 0, int $ordem = 0, string $imagem = "", string $descricao = "", string $resposta = "", int $fk_id_pergunta = 0)

    {
        $this->id_respostaimagem = $id_respostaimagem;
        $this->ordem = $ordem;
        $this->imagem = base64_decode($imagem); 
        $this->descricao = $descricao;
        $this->resposta = $resposta;
        $this->fk_id_pergunta = $fk_id_pergunta;
        $this->Conexao = new Conexao();
        $this->Conexao->conectar();
    }

    public function GetImagemResposta($id_pergunta)
    {
        try {
            $pdo = $this->Conexao->getPdo();
    
            $query = "SELECT * FROM resposta_imagem WHERE fk_id_pergunta = :id_pergunta";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $stmt->execute();
    
            $imagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $result = [];
            foreach ($imagens as $imagem) {
                $result[] = new Respostaimagem(
                    $imagem['id_respostaimagem'],
                    $imagem['ordem'],
                    stream_get_contents($imagem['imagem']), 
                    $imagem['descricao'],
                    $imagem['resposta'],
                    $imagem['fk_id_pergunta']
                );
            }
    
            return $result;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
?>
