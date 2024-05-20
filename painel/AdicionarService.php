<?php
include_once '../php_action/ClassePergunta.php';
include_once '../php_action/ClasseResposta_Imagem.php';
class AdicionarService
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
         
         header('Location: adicionarpergunta.php');
      }
      
   }
}


