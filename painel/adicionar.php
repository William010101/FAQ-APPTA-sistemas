<?php
session_start();
// Header

include_once 'includes/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col offset-md-1 mt-4 col-lg-8">
            <h3 class="font-weight-light mt-1 mb-3"> Cadastro FAQ </h3>
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
                        <textarea class="border border w-100 p-2" id="video" name="video"
                        rows="5" cols="33"></textarea>
                    </div>

                <?php
                        $sql = "SELECT * FROM produto where categoria = 'Primario'";
                        $resultado = pg_query($conn, $sql);
                        
                ?>

                <div class="form-group">
                    <h6><label class="mb-0">Produto Principal</label></h6>
                    <select class="custom-select" id="produto" name="produto">
                        <?php while($dados = pg_fetch_array($resultado)): ?>
                        <option><?php echo $dados['nomeproduto'];?></option>
                        <?php  endwhile; ?>

                    </select>
                </div>


                <?php
                        $sql = "SELECT * FROM produto where categoria = 'Secundario'";
                        $resultado = pg_query($conn, $sql);
                        
                ?>
                <div class="form-group">
                    <h6><label class="mb-0">Sub Categoria</label></h6>
                    <select class="custom-select" id="subCategoria" name="subCategoria">
                        <?php while($dados = pg_fetch_array($resultado)): ?>
                        <option><?php echo $dados['nomeproduto'];?></option>
                        <?php  endwhile; ?>

                    </select>
                </div>

                <input type="hidden" id="dataCadastro" name="dataCadastro" value="<?php 
                date_default_timezone_set ('America/Sao_Paulo');
                $data = new DateTime();
                 echo $data->format('d-m-Y H:i:s');
                ?>">

                <?php
                        $usuario = $_SESSION['id_usuario'];
                        $sql = "SELECT * FROM usuarios where id_usuario ='$usuario'";
                        $resultado = pg_query($conn, $sql);
                        $dados = pg_fetch_array($resultado);
                ?>

                <input type="hidden" id="usuarioCadastro" name="usuarioCadastro" value="<?php echo $dados['nome'];?>">
                <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo $usuario?>">

                <button type="submit" name="btn-cadastrar" class="btn btn-primary mb-4"> Cadastrar </button>
                <a href="faq.php" class="btn btn-success mb-4" data-toggle="modal" data-target="#confirmarsaida"
                    id="voltar"> Lista de perguntas </a>
            </form>
        </div>
    </div>
</div>

<?php
// Footer
include_once 'includes/footer.php';
?>