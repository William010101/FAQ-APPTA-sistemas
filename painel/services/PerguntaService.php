<?php
include_once '../php_action/ClassePergunta.php';
include_once '../php_action/ClasseResposta_Imagem.php';
class PerguntaService
{

   public function PostPergunta()
   {
      
      if (isset($_POST['btn-cadastrar-pergunta'])) {
         $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

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

         $idpergunta = $pergunta->CadastroPergunta($pergunta);
         if (isset($_FILES['imagem'])) {
            $imagens = $_FILES['imagem'];
            foreach ($imagens['tmp_name'] as $key => $tmp_name) {
               $imagem_tmp = $tmp_name;
               if (is_uploaded_file($imagem_tmp)) {
                  $imagem = file_get_contents($imagem_tmp);

                  $descricao = isset($dados['descricao'][$key]) ? $dados['descricao'][$key] : '';
                  $ordem = isset($dados['ordem'][$key]) ? (int) $dados['ordem'][$key] : 0;
                  $id_fk_pergunta = $idpergunta;
                  $respostaimagem = isset($dados['respostaimagem'][$key]) ? $dados['respostaimagem'][$key] : '';

                  $respostaImagemObj = new Respostaimagem(0, $ordem, $imagem, $descricao, $respostaimagem, $id_fk_pergunta);
                  $respostaImagemObj->CadastroImagemResposta($respostaImagemObj);
               }
            }
            echo'Imagens inseridas';
            
         }
         
      }
      
   }

   public function DeletarSecao()
   {
      if(isset($_POST['deletar-secao'])){

         $respostaimagem = new Respostaimagem();
         $idrespostaimagem = $_POST['idrespostaimagem'];
         
         $veirificaDelete = $respostaimagem->DeletarImagem($idrespostaimagem);
         if($veirificaDelete == true){
         header("Refresh: 0"); 
         }
      }
   }

   public function SetPergunta() {
      if (isset($_POST['btn-editarpergunta'])) {
          // Criar objeto Pergunta e atribuir os dados
          $pergunta = new Pergunta();
          $pergunta->id_pergunta = $_POST['id_pergunta'];
          $pergunta->pergunta = $_POST['pergunta'];
          $pergunta->resposta = $_POST['resposta'];
          $pergunta->datacadastro = $_POST['dataCadastro'];
          $pergunta->chave = $_POST['chave'];
          $pergunta->video = $_POST['video'];
          $pergunta->usuario = $_POST['usuarioCadastro'];
          $pergunta->idusuario = $_POST['usuarioId'];
          $pergunta->visivel = isset($_POST['visivel']) && $_POST['visivel'] == '1' ? true : false;
          $pergunta->fk_id_subcategoria = $_POST['fk_id_subcategoria'];       
  
          // Inserir a pergunta no banco de dados
          
         $pergunta->SetPergunta($pergunta);
         $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT );
         var_dump($dados);
         $novassecoes = new Respostaimagem();
          // Se houver uma nova imagem enviada
          if(isset($_FILES['nova_imagem']) && $_FILES['nova_imagem']['error'] === UPLOAD_ERR_OK) {

            $conteudo_imagem = file_get_contents($_FILES['nova_imagem']['tmp_name']);
            if($conteudo_imagem !== false) {
               $novassecoes->imagem = $conteudo_imagem;
            }else {
            $imagem = $novassecoes->GetImagemResposta($_POST['idrespostaimagem']);
            foreach ($imagem as $img) {
               $novassecoes->imagem = $img->imagem;
            }
            }
            $novassecoes->id_respostaimagem = $dados['idrespostaimagem'];
            $novassecoes->descricao = $dados['descricao'];
            $novassecoes->ordem =  (int) $dados['ordem'];
            $novassecoes->respostaimagem = $dados['respostaimagem'];
            $novassecoes->id_fk_pergunta = $dados['id_fk_pergunta'];
            $novassecoes->SetImagem($novassecoes);
            
              // Inserir a resposta de imagem no banco de dados
              return "aaaaaaaaaaaaaaaaaaaaa"; //var_dump($novassecoes);//
         }
      }
  }
}


