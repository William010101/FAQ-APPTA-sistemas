<?php
require_once 'ClasseConnection.php'; 
require_once 'ClassePergunta.php'; 

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

    public function CadastroImagemResposta($dados)
    {
        var_dump($dados);
        try {

            if (isset($_FILES['imagem'])) {
                $imagens = $_FILES['imagem'];
                foreach ($imagens['tmp_name'] as $key => $tmp_name) {
                    $imagem_tmp = $tmp_name;
                    if (is_uploaded_file($imagem_tmp)) {
                        $imagem = file_get_contents($imagem_tmp);
                        $imagemcod = base64_encode($imagem);
                        $descricao = isset($dados['descricao'][$key]) ? $dados['descricao'][$key] : '';
                        $ordem = isset($dados['ordem'][$key]) ? $dados['ordem'][$key] : '';
                        $id_fk_pergunta = isset($dados['id_fk_pergunta'][$key]) ? $dados['id_fk_pergunta'][$key] : '';
                        $respostaimagem = isset($dados['respostaimagem'][$key]) ? $dados['respostaimagem'][$key] : '';
                        echo '<div>';
                        echo '<img src="data:image/jpeg;base64,' . $imagemcod . '" alt="Imagem">';
                        echo '<p>Descrição: ' . $descricao . '</p>';
                        echo '<p>Resposta da Imagem: ' . $respostaimagem . '</p>';
                        echo '<p>ordem da Imagem: ' . $ordem . '</p>';
                        echo '<p>id pergunta da Imagem: ' . $id_fk_pergunta . '</p>';
                        echo '</div>';
                    } else {
                        echo "Erro ao carregar a imagem.";
                    }
                }
            } else {
                echo "Nenhuma imagem enviada.";
            }
        } catch (PDOException $e) {
            echo "Erro ao inserir a Imagem: " . $e->getMessage();
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
