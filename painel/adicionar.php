<?php
session_start();
// Header
include_once 'includes/ref.php';
include_once 'includes/header.php';
include_once '../php_action/ClasseSubcategoria.php';
include_once '../php_action/ClasseConnection.php';
$subcategoria = new Subcategoria();
?>

<div class="container ">
    <div class="row ">
        <div class="col offset-md-1 mt-4 col-lg-8 mx-auto">
            <h3 class="font-weight-light mt-1 mb-3"> Cadastro E-Manual </h3>
            <form name="form1" action="php_action/create.php" method="POST">

                <div class="form-group">
                    <h6> <label class="mb-0" for="pergunta">Titulo</label><br></h6>
                    <input class="border w-100 p-2" type="text" name="pergunta" id="pergunta"
                        placeholder="Titulo da pergunta">

                </div>

                <div class="form-group">
                    <h6><label class="mb-0 " for="resposta">Resposta</label></h6>
                    <textarea class="form-control border ckeditor" rows="4" name="resposta"
                        id="resposta"></textarea>
                </div>

                <div class="form-group">

                    <h6><label class="mb-0" for="chave">Chave </label></h6>
                    <input class="border border w-100 p-2" name="chave" id="chave" placeholder="Palavra Chave"
                        data-role="tagsinput">

                </div>

                <div class="form-group">

                <h6><label class="mb-0" for="video">Video </label></h6>                  
                        <input class="border border w-100 p-2" id="video" name="video" placeholder="Cole aqui o código de incorporação do vídeo"></in>
                    </div>

                    <h6> <label class="mb-0" for="pergunta">Nome da Subcategoria relacionada</label><br></h6>
             
                    <select  class="form-select" id="floatingSelect" aria-label="Floating label select example" name="fk_id_subcategoria" id="fk_id_subcategoria" >
                        <option selected>Selecione </option>
                        <?php
                            $subcategorias = $subcategoria->GetTodasSubcategorias();
                            foreach ($subcategorias as $sub):
                        ?>
                        <option value="<?php echo $sub->id_subcategoria; ?>"><?php echo $sub->nomesubcategoria; ?></option>
                        <?php endforeach; ?>
                    </select>

                <input type="hidden" id="dataCadastro" name="dataCadastro" value="<?php 
                date_default_timezone_set ('America/Sao_Paulo');
                $data = new DateTime();
                 echo $data->format('d-m-Y H:i:s');
                ?>">

                <?php
                        // $usuario = $_SESSION['id_usuario'];
                        // $sql = "SELECT * FROM usuarios where id_usuario ='$usuario'";
                        // $resultado = pg_query($conn, $sql);
                        // $dados = pg_fetch_array($resultado);
                ?>

                <input type="hidden" id="usuarioCadastro" name="usuarioCadastro" value="<?php echo $dados['nome'];?>">
                <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo $usuario?>">

                <button type="submit" name="btn-cadastrar" class="btn btn-primary mb-4 mt-4"> Cadastrar </button>
                <a href="faq.php" class="btn btn-success mb-4 mt-4" data-toggle="modal" data-target="#confirmarsaida"
                    id="voltar"> Lista de perguntas </a>
            </form>
        </div>
    </div>
</div>

<?php
// Footer
include_once 'includes/footer.php';
?>