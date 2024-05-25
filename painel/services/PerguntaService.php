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
          //$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

          $pergunta = new Pergunta();
          $pergunta->id_pergunta = $_POST['id_pergunta'];
          $pergunta->pergunta = $_POST['pergunta'];
          $pergunta->resposta = $_POST['resposta'];
          $pergunta->datacadastro =$_POST['dataCadastro'];
          $pergunta->chave = $_POST['chave'];
          $pergunta->video = $_POST['video'];
          $pergunta->fk_id_subcategoria = $_POST['fk_id_subcategoria'];
          $pergunta->usuario = $_POST['usuarioCadastro'];
          $pergunta->idusuario = $_POST['usuarioId'];
          $pergunta->visivel = $_POST['visivel'];
   
          return var_dump($pergunta);
          //$pergunta->SetPergunta($pergunta);

         // if (isset($_FILES['imagem'])) {
         //    $imagens = $_FILES['imagem'];
         //    foreach ($imagens['tmp_name'] as $key => $tmp_name) {
         //       $imagem_tmp = $tmp_name;
         //       if (is_uploaded_file($imagem_tmp)) {
         //          $imagem = file_get_contents($imagem_tmp);
         //          $idrespostaimagem = $dados['idrespostaimagem'][$key];
         //          $descricao = $dados['descricao'][$key];
         //          $ordem =  (int) $dados['ordem'][$key];
         //          $respostaimagem = $dados['respostaimagem'][$key] ;
         //          $id_fk_pergunta = $dados['id_fk_pergunta']['$key'];

         //          $respostaImagemObj = new Respostaimagem($idrespostaimagem, $ordem, $imagem, $descricao, $respostaimagem, $id_fk_pergunta);
         //          $respostaImagemObj->CadastroImagemResposta($respostaImagemObj);
         //       }
         //    }
            
         // }
         
      }
   }
}


