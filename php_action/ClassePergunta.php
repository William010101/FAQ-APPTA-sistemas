<?php
require_once 'ClasseConnection.php';

class Pergunta
{
    public int $id_pergunta;
    public string $pergunta;
    public string $resposta;
    public string $chave;
    public string $datacadastro;
    public? string $dataedicao;
    public? string $solucao;
    public string $video;
    public string $usuario;
    public int $idusuario;
    public bool $visivel;
    public ?int $fk_id_subcategoria; // Permite que seja nulo
    public ?int $fk_id_categoria;    // Permite que seja nulo
    private $Conexao;

    public function __construct()
    {
        $this->Conexao = new Conexao();
        
    }



    public function DeletarPergunta($idpergunta)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            $sql1 = "DELETE FROM resposta_imagem WHERE fk_id_pergunta = :id_pergunta";
            $stmt1 = $pdo->prepare($sql1);
            $stmt1->bindParam(':id_pergunta', $idpergunta, PDO::PARAM_INT);
            $stmt1->execute();

            // Deletar da tabela pergunta em seguida
            $sql2 = "DELETE FROM pergunta WHERE id_pergunta = :id_pergunta";
            $stmt2 = $pdo->prepare($sql2);
            $stmt2->bindParam(':id_pergunta', $idpergunta, PDO::PARAM_INT);
            $stmt2->execute();

        } catch (PDOException $e) {
            echo "Erro ao deletar a pergunta: " . $e->getMessage();
        }
    }


    public function SetPergunta(Pergunta $pergunta)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            if ($pergunta->visivel == 1) {
                $query = "  UPDATE pergunta SET pergunta = :pergunta, resposta = :resposta, datacadastro = :datacadastro, chave = :chave, video = :video, usuario = :usuario, idusuario = :idusuario, visivel = :visivel, fk_id_subcategoria = :fk_id_subcategoria, fk_id_categoria = :fk_id_categoria, solucao = :solucao, dataedicao = :dataedicao WHERE id_pergunta = :id_pergunta";
            } else {
                $query = "  UPDATE pergunta SET pergunta = :pergunta, resposta = :resposta, datacadastro = :datacadastro, chave = :chave, video = :video, usuario = :usuario, idusuario = :idusuario, visivel = :visivel, fk_id_subcategoria = :fk_id_subcategoria, fk_id_categoria = :fk_id_categoria, solucao = :solucao, dataedicao = :dataedicao WHERE id_pergunta = :id_pergunta";
            }
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_pergunta', $pergunta->id_pergunta, PDO::PARAM_INT);
            $stmt->bindParam(':pergunta', $pergunta->pergunta, PDO::PARAM_STR);
            $stmt->bindParam(':resposta', $pergunta->resposta, PDO::PARAM_STR);
            $stmt->bindParam(':datacadastro', $pergunta->datacadastro, PDO::PARAM_STR);
            $stmt->bindParam(':dataedicao', $pergunta->dataedicao, PDO::PARAM_STR);
            $stmt->bindParam(':chave', $pergunta->chave, PDO::PARAM_STR);
            $stmt->bindParam(':solucao', $pergunta->solucao, PDO::PARAM_STR);
            $stmt->bindParam(':video', $pergunta->video, PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $pergunta->usuario, PDO::PARAM_STR);
            $stmt->bindParam(':idusuario', $pergunta->idusuario, PDO::PARAM_INT);
            $stmt->bindParam(':visivel', $pergunta->visivel, PDO::PARAM_BOOL);
            $stmt->bindParam(':fk_id_subcategoria', $pergunta->fk_id_subcategoria, PDO::PARAM_INT);
            $stmt->bindParam(':fk_id_categoria', $pergunta->fk_id_categoria, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "Erro ao editar a pergunta: " . $e->getMessage();
        }
    }
    public function CadastroPergunta(Pergunta $pergunta)
    {
        try {
            $pdo = $this->Conexao->getPdo();

            $query = "INSERT INTO pergunta (pergunta, resposta, datacadastro, dataedicao, chave, video, usuario, idusuario, visivel, fk_id_subcategoria,  fk_id_categoria, solucao) VALUES 
            (:pergunta, :resposta, :datacadastro, :dataedicao, :chave, :video, :usuario, :idusuario, :visivel, :fk_id_subcategoria, :fk_id_categoria, :solucao)";

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':pergunta', $pergunta->pergunta, PDO::PARAM_STR);
            $stmt->bindParam(':resposta', $pergunta->resposta, PDO::PARAM_STR);
            $stmt->bindParam(':datacadastro', $pergunta->datacadastro, PDO::PARAM_STR);
            $stmt->bindParam(':dataedicao', $pergunta->dataedicao, PDO::PARAM_STR);
            $stmt->bindParam(':chave', $pergunta->chave, PDO::PARAM_STR);
            $stmt->bindParam(':solucao', $pergunta->solucao, PDO::PARAM_STR);
            $stmt->bindParam(':video', $pergunta->video, PDO::PARAM_STR);
            $stmt->bindParam(':usuario', $pergunta->usuario, PDO::PARAM_STR);
            $stmt->bindParam(':idusuario', $pergunta->idusuario, PDO::PARAM_INT);
            $stmt->bindParam(':visivel', $pergunta->visivel, PDO::PARAM_BOOL);
            $stmt->bindParam(':fk_id_subcategoria', $pergunta->fk_id_subcategoria, PDO::PARAM_INT);
            $stmt->bindParam(':fk_id_categoria', $pergunta->fk_id_categoria, PDO::PARAM_INT);
            $stmt->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao inserir a pergunta: " . $e->getMessage();
        }
    }


    public function GetTodasPerguntas()
    {

        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT * FROM pergunta ORDER BY id_pergunta";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pergunta');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    public function GetCatPerguntas($nome, $id_categoria)
    {

        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT * FROM pergunta 
            JOIN categoria ON (nomecategoria = :nome) WHERE fk_id_categoria = :id_categoria AND pergunta.visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pergunta');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    public function GetSubPerguntas($nomesub, $id_subcategoria)
    {

        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT * FROM pergunta 
            JOIN subcategoria ON (nomesubcategoria = :nomesub) WHERE fk_id_subcategoria = :id_subcategoria AND pergunta.visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_subcategoria', $id_subcategoria, PDO::PARAM_INT);
            $stmt->bindParam(':nomesub', $nomesub, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pergunta');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    public function GetPerguntasCat($id_categoria)
    {

        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM pergunta where fk_id_categoria = :id_categoria AND visivel = true";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pergunta');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    public function GetPerguntaSub($id_subcategoria)
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
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function GetPergunta($id_pergunta)
    {

        try {
            $pdo = $this->Conexao->getPdo();

            $query = "SELECT * FROM pergunta where id_pergunta = :id_pergunta";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pergunta');
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
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
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    public function BreadCrumbPerguntaCat($nome)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT id_produto, nomeproduto , id_categoria, nomecategoria
            FROM produto
            INNER JOIN categoria ON id_produto = categoria.fk_id_produto
            WHERE nomecategoria = :nome";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
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
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    public function BreadCrumbRepostaCat($id_pergunta)
    {
        try {
            $pdo = $this->Conexao->getPdo();
            $query = "SELECT id_produto, nomeproduto , id_categoria, nomecategoria, id_pergunta, pergunta
            FROM pergunta
            INNER JOIN categoria ON id_categoria = pergunta.fk_id_categoria
            INNER JOIN produto ON id_produto = categoria.fk_id_produto
            WHERE id_pergunta = :id_pergunta
            LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    public function Pesquisar()
    {

        if (isset($_POST['btnpesquisar'])) {
            $palavraChave = strtolower($_POST['pesquisar']);
            $pergunta = new Pergunta();
        }
        try {
            $pdo = $this->Conexao->getPdo();
            
            $query = 
                "   SELECT DISTINCT id_pergunta, pergunta, resposta, nomesubcategoria, nomecategoria, nomeproduto FROM (
                    SELECT 1 AS ordem, id_pergunta, pergunta, resposta, nomesubcategoria, nomecategoria, nomeproduto FROM pergunta
                    LEFT JOIN subcategoria ON (id_subcategoria = fk_id_subcategoria)
                    JOIN categoria ON (id_categoria = subcategoria.fk_id_categoria or id_categoria = pergunta.fk_id_categoria)
                    JOIN produto ON (fk_id_produto = id_produto)
                    WHERE " . $pergunta->obterclausulawhere("chave", $palavraChave) . " 

                    UNION  

                    SELECT 2 AS ordem, id_pergunta, pergunta, resposta, nomesubcategoria, nomecategoria, nomeproduto FROM pergunta
                    LEFT JOIN subcategoria ON (id_subcategoria = fk_id_subcategoria)
                    JOIN categoria ON (id_categoria = subcategoria.fk_id_categoria or id_categoria = pergunta.fk_id_categoria)
                    JOIN produto ON (fk_id_produto = id_produto)
                    WHERE " . $pergunta->obterclausulawhere("pergunta", $palavraChave) . "

                    UNION

                    SELECT 3 AS ordem, id_pergunta, pergunta, resposta, nomesubcategoria, nomecategoria, nomeproduto FROM pergunta 
                    LEFT JOIN subcategoria ON (id_subcategoria = fk_id_subcategoria)
                    JOIN categoria ON (id_categoria = subcategoria.fk_id_categoria or id_categoria = pergunta.fk_id_categoria)
                    JOIN produto ON (fk_id_produto = id_produto)
                    WHERE " . $pergunta->obterclausulawhere("nomesubcategoria", $palavraChave) . "

                    UNION

                    SELECT 4 AS ordem, id_pergunta, pergunta, resposta, nomesubcategoria, nomecategoria, nomeproduto FROM pergunta 
                    LEFT JOIN subcategoria ON (id_subcategoria = fk_id_subcategoria)
                    JOIN categoria ON (id_categoria = subcategoria.fk_id_categoria or id_categoria = pergunta.fk_id_categoria)
                    JOIN produto ON (fk_id_produto = id_produto)
                    WHERE " . $pergunta->obterclausulawhere("nomecategoria", $palavraChave) . "
                    ORDER BY ordem 
                ) AS TAB";

            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 

            return $results; 
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }
    public function obterclausulawhere( $nomeDocampo,  $palavraChave)
    {

        $palavraPesquisa = explode(" ", $palavraChave);
        $clausulaWhere = '';
        for ($i = 0; $i < count($palavraPesquisa); $i++) {
            if ($i == 0) {
                $clausulaWhere .= " LOWER($nomeDocampo) LIKE " . "'%" . $palavraPesquisa[$i] . "%'";
            } else {
                $clausulaWhere .= " AND LOWER($nomeDocampo) LIKE " . "'%" . $palavraPesquisa[$i] . "%'";
            }
        }

        return $clausulaWhere;
    }

   

}

