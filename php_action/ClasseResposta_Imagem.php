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
        $this->imagem = $imagem; 
        $this->descricao = $descricao;
        $this->resposta = $resposta;
        $this->fk_id_pergunta = $fk_id_pergunta;
        $this->Conexao = new Conexao();
        $this->Conexao->conectar();
    }

    // public function SetImagem(Respostaimagem $respostaimagem)
    // {
    //     try {
    //         $pdo = $this->Conexao->getPdo();
    //             $query = "  UPDATE pergunta SET pergunta = :pergunta, resposta = :resposta, datacadastro = :datacadastro, chave = :chave, video = :video, usuario = :usuario, idusuario = :idusuario, visivel = :visivel WHERE fk_id_subcategoria = :fk_id_subcategoria";
    //         }else{
    //             $query = "  UPDATE pergunta SET pergunta = :pergunta, resposta = :resposta, datacadastro = :datacadastro, chave = :chave, video = :video, usuario = :usuario, idusuario = :idusuario, visivel = :visivel WHERE fk_id_subcategoria = :fk_id_subcategoria";
    //         }
    //         $stmt = $pdo->prepare($query);
    //         $stmt->bindParam(':pergunta', $pergunta->pergunta, PDO::PARAM_STR);
    //         $stmt->bindParam(':resposta', $pergunta->resposta, PDO::PARAM_STR);
    //         $stmt->bindParam(':datacadastro', $pergunta->datacadastro, PDO::PARAM_STR);
    //         $stmt->bindParam(':chave', $pergunta->chave, PDO::PARAM_STR);
    //         $stmt->bindParam(':video', $pergunta->video, PDO::PARAM_STR);
    //         $stmt->bindParam(':usuario', $pergunta->usuario, PDO::PARAM_STR);
    //         $stmt->bindParam(':idusuario', $pergunta->idusuario, PDO::PARAM_INT);
    //         $stmt->bindParam(':visivel', $pergunta->visivel, PDO::PARAM_BOOL);
    //         $stmt->bindParam(':fk_id_subcategoria', $pergunta->fk_id_subcategoria, PDO::PARAM_INT);
    //         $stmt->execute();
    //         return $pdo->lastInsertId();
        
    //     } catch (PDOException $e) {
    //         echo "Erro ao editar a pergunta: " . $e->getMessage();
    //     }
    // }

    public function DeletarImagem($idrespostaimagem)
    {
        try {
            $pdo = $this->Conexao->getPdo();
                $query = "DELETE FROM resposta_imagem WHERE id_respostaimagem = :idrespostaimagem";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':idrespostaimagem', $idrespostaimagem, PDO::PARAM_INT);
                $stmt->execute();
                return true;
        } catch (PDOException $e) {
            echo "Erro ao deletar o imagem: " . $e->getMessage();
        }
    }
    public function CadastroImagemResposta(Respostaimagem $respostaimagem)
{
    try {
        $pdo = $this->Conexao->getPdo();
        
        $query = "INSERT INTO resposta_imagem (ordem, imagem, descricao, resposta, fk_id_pergunta) VALUES (:ordem, :imagem, :descricao, :resposta, :fk_id_pergunta)";
        
        $stmt = $pdo->prepare($query);
        
        $stmt->bindValue(':ordem', $respostaimagem->ordem, PDO::PARAM_INT);
        $stmt->bindValue(':imagem', $respostaimagem->imagem, PDO::PARAM_LOB);
        $stmt->bindValue(':descricao', $respostaimagem->descricao, PDO::PARAM_STR);
        $stmt->bindValue(':resposta', $respostaimagem->resposta, PDO::PARAM_STR);
        $stmt->bindValue(':fk_id_pergunta', $respostaimagem->fk_id_pergunta, PDO::PARAM_INT);
        $stmt->execute();
        
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
            // Lê o recurso do campo 'imagem' como uma string
            $imagemBinario = stream_get_contents($imagem['imagem']);
            $result[] = new Respostaimagem(
                $imagem['id_respostaimagem'],
                $imagem['ordem'],
                $imagemBinario, // Passa a string lida
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
