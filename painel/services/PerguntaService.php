<?php
// Inclua os arquivos necessários usando caminhos absolutos
$rootPath = dirname(__DIR__,2);

// Inclua os arquivos necessários usando caminhos absolutos
include $rootPath . '\php_action\ClassePergunta.php';
include $rootPath . '\php_action\ClasseResposta_Imagem.php';
$service = new PerguntaService();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if (isset($_POST['deletar-secao']) && $_POST['deletar-secao'] === 'deletar') {
       $service->DeletarSecao();
   }
}
 class PerguntaService
{
   function Pesquisa()
   {
      if (isset($_POST['btnpesquisar'])){
      $pergunta = new Pergunta();
      $pesquisar = $_POST['pesquisar'];
      $pergunta->Pesquisa($pesquisar);
   }
   }

     function PostPergunta()
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
            

         }
         header('Location: perguntas.php');
      }

   }

   function DeletarPergunta()
   {  
      if (isset($_POST['btn-deletar-pergunta'])) {
      $pergunta = new Pergunta();
      $idpergunta = $_POST['id_pergunta'];
      $pergunta->DeletarPergunta($idpergunta);
      }
   }
   function DeletarSecao()
   {
       if (isset($_POST['idrespostaimagem'])) {
           $idrespostaimagem = $_POST['idrespostaimagem'];
   
           echo "ID da seção a ser excluída: " . $idrespostaimagem . "\n";
           $respostaimagem = new Respostaimagem();
           $veirificaDelete = $respostaimagem->DeletarImagem($idrespostaimagem);
   
           if ($veirificaDelete == true) {
               echo "Seção excluída com sucesso!";
           } else {
               echo "Erro ao excluir a seção.";
           }
       } else {
           echo "ID da seção não foi fornecido.";
       }
   }
     function SetPergunta()
   {
      if (isset($_POST['btn-editarpergunta'])) {
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

         $pergunta->SetPergunta($pergunta);
         
         $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
         if (isset($_FILES['imagem'])) {
            $imagens = $_FILES['imagem'];
            foreach ($imagens['tmp_name'] as $key => $tmp_name) {
               $imagem_tmp = $tmp_name;
               if (is_uploaded_file($imagem_tmp)) {
                  $imagem = file_get_contents($imagem_tmp);

                  $descricao = isset($dados['descricao'][$key]) ? $dados['descricao'][$key] : '';
                  $ordem = isset($dados['ordem'][$key]) ? (int) $dados['ordem'][$key] : 0;
                  $id_fk_pergunta = isset($dados['id_fk_pergunta'][$key]) ? (int) $dados['id_fk_pergunta'][$key] : 0;
                  $respostaimagem = isset($dados['respostaimagem'][$key]) ? $dados['respostaimagem'][$key] : '';

                  $respostaImagemObj = new Respostaimagem(0, $ordem, $imagem, $descricao, $respostaimagem, $id_fk_pergunta);
                  $respostaImagemObj->CadastroImagemResposta($respostaImagemObj);
               }
            }
         }
         if(isset($dados['idrespostaimagem']))
         {
         $tamanho = count($dados['idrespostaimagem']);
         }else{
            $tamanho = 0;
         }
         $novassecoes = new Respostaimagem();
         
         for ($i = 0; $i < $tamanho; $i++) {
            if (isset($_FILES['nova_imagem']['tmp_name'][$i]) && !empty($_FILES['nova_imagem']['tmp_name'][$i])) {

               $conteudo_imagem = file_get_contents($_FILES['nova_imagem']['tmp_name'][$i]);
               $novassecoes->id_respostaimagem = $dados['idrespostaimagem'][$i];
               $novassecoes->ordem = (int) $dados['ordemcad'][$i];
               $novassecoes->imagem = $conteudo_imagem;

               $novassecoes->descricao = $dados['descricaocad'][$i];
               $novassecoes->resposta = $dados['respostaimagemcad'][$i];
               $novassecoes->fk_id_pergunta = $dados['id_fk_pergunta'][$i];
                $novassecoes->SetImagem($novassecoes);
            } else {
                  $imagem = $novassecoes->GetImagemResposta($dados['idrespostaimagem'][$i]);

                  foreach ($imagem as $img) {
                     $novassecoes->imagem = $img->imagem;

                  $novassecoes->id_respostaimagem = $dados['idrespostaimagem'][$i];
                  $novassecoes->descricao = $dados['descricaocad'][$i];
                  $novassecoes->ordem = (int) $dados['ordemcad'][$i];
                  $novassecoes->resposta = $dados['respostaimagemcad'][$i];
                  $novassecoes->fk_id_pergunta = $dados['id_fk_pergunta'][$i];
                  $novassecoes->SetImagem($novassecoes);
               } 

            }
           
         } 
         if (!isset($_SESSION['reloaded'])) {
            $_SESSION['reloaded'] = true;
            echo '<script type="text/javascript">location.reload();</script>';
            exit();
        } else {
            unset($_SESSION['reloaded']);
        }

      }
         
   }
}



