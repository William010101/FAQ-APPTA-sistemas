<?php
 include_once '../php_action/ClassePergunta.php';
 class AdicionarService
 {

 public function PostPergunta()
        
    {
     if(isset($_POST['btn-cadastrar-pergunta'])){
        
        // Cria uma nova instância de Pergunta e atribui os valores recebidos
        $pergunta = new Pergunta();
        $pergunta->pergunta = $_POST['pergunta'];
        $pergunta->resposta = $_POST['resposta'];
        $pergunta->chave = $_POST['chave'];           
        $pergunta->video = $_POST['video'];
        $pergunta->fk_id_subcategoria = $_POST['fk_id_subcategoria'];
        $pergunta->datacadastro = $_POST['dataCadastro'];
        $pergunta->usuario = $_POST['usuarioCadastro']; 
        $pergunta->idusuario = $_POST['usuarioId'];
        $pergunta->visivel = $_POST['visivel']; 

        // Chama o método CadastroPergunta na mesma instância de AdicionarService
        $pergunta->CadastroPergunta($pergunta);
        
        header('Location: adicionar.php');
                //POST IMG
                //  foreach (iamgem to imagens)
                //  {
                //     RespostaImagem resp = new ImagemRespota();
                //     rsps.IdPergunta = $idperguntaIMG
                //     resp->Imagem = iamgem.imagem

                //  }
                 
                
                // $query = "INSERT INTO per$idpergunta (pergunta, resposta, datacadastro, chave, video, usuario, idusuario, visivel, fk_id_subcategoria)VALUES (:pergunta, :resposta, :datacadastro, :chave, :video, :usuario, :idusuario, :visivel, :fk_id_subcategoria)";
                // $stmt = $pdo->prepare($query);
                // $stmt->bindParam(':pergunta', $pergunta->pergunta, PDO::PARAM_STR);
                // $stmt->bindParam(':resposta', $pergunta->resposta, PDO::PARAM_STR);
                // $stmt->bindParam(':datacadastro', $pergunta->datacadastro, PDO::PARAM_STR);
                // $stmt->bindParam(':chave',$pergunta->chave, PDO::PARAM_STR);
                // $stmt->bindParam(':video', $pergunta->video, PDO::PARAM_STR);
                // $stmt->bindParam(':usuario', $pergunta->usuario, PDO::PARAM_STR);
                // $stmt->bindParam(':idusuario', $pergunta->idusuario, PDO::PARAM_INT);
                // $stmt->bindParam(':visivel', $pergunta->visivel, PDO::PARAM_BOOL);
                // $stmt->bindParam(':fk_id_subcategoria', $pergunta->fk_id_subcategoria, PDO::PARAM_INT);
                // $stmt->execute();
                // return $pdo->lastInsertId();       
    }
    }
}  


