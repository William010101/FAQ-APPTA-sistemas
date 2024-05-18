<?php
require_once 'ClasseConnection.php'; 

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

    public function CadastroImagemResposta(Respostaimagem $respostaimagem)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            
            $query = "INSERT INTO resposta_imagem (ordem, imagem, descricao, resposta, fk_id_pergunta) VALUES (:ordem, :imagem, :descricao, :resposta, :fk_id_pergunta)";
            
            // Prepare a consulta uma vez fora do loop
            $stmt = $pdo->prepare($query);
            
           // foreach ($respostasImagem as $respostaImagem) {
                // Use bindValue para evitar referências problemáticas
                $stmt->bindValue(':ordem', $respostaimagem->ordem, PDO::PARAM_INT);
                $stmt->bindValue(':imagem', $respostaimagem->imagem, PDO::PARAM_LOB);
                $stmt->bindValue(':descricao', $respostaimagem->descricao, PDO::PARAM_STR);
                $stmt->bindValue(':resposta', $respostaimagem->resposta, PDO::PARAM_STR);
                $stmt->bindValue(':fk_id_pergunta', $respostaimagem->fk_id_pergunta, PDO::PARAM_INT);
                $stmt->execute();
            //}
            
            echo "Imagens inseridas com sucesso.";
        } catch (PDOException $e) {
            echo "Erro ao inserir as imagens: " . $e->getMessage();
        }
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
