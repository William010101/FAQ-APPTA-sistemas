<?php
include_once '../php_action/ClasseProduto.php';
class ProdutoService
{

    public function PostProduto()
    {

        if(isset($_POST['btn-cadastrarproduto'])) {
            $produto = new Produto();
            $produto->nomeproduto = $_POST['nomeproduto'];
            if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $conteudo_imagem = file_get_contents($_FILES['imagem']['tmp_name']);
                if($conteudo_imagem !== false) {
                    $produto->imagem = $conteudo_imagem;
                } else {
                    echo "Erro ao ler o conteúdo da imagem.";
                }
            } else {
                echo "Erro ao enviar o arquivo ou nenhum arquivo enviado.";
            }
            $produto->visivel = $_POST['visivel'];
            
        }
        $produto->CadastroProduto($produto);
        return "Produto cadastrado com sucesso!";
    }

}

?>