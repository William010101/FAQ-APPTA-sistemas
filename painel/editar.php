<?php
    session_start();
    // Conexão
    include_once 'php_action/db_connect.php';
    // Header
    include_once 'includes/header.php';

    // Select
    if(isset($_GET['id'])):
        $id = pg_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM pergunta WHERE id_pergunta = '$id'";
        $resultado = pg_query($conn, $sql);
        $dados = pg_fetch_array($resultado);
        $usuario= $dados['usuario'];
        $opcaoativa = $dados['produto'];
        $opcaosubCategoria = $dados['subcategoria'];
        $idUsuario= $dados['idusuario'];
        
    endif;
?>


<div class="container">
    <div class="row">
        <div class="col offset-md-1 mt-4 col-lg-8">
            <p class="h1 font-weight-light">Editar Pergunta </p>
            <form name="formulario" action="php_action/update.php" method="POST">
                <input type="hidden" name="id_pergunta" value="<?php echo $dados['id_pergunta'];?>">
                <div class="form-group">

                    <h6> <label class="mb-0" for="pergunta">Titulo</label><br></h6>
                    <input class="border w-100 p-2" type="text" name="pergunta" id="pergunta"
                        value="<?php echo $dados['pergunta']; ?>" placeholder="pergunta">

                </div>

                <div class="form-group">

                    <h6><label class="mb-0 " for="resposta">Resposta</label></h6>
                    <textarea class="form-control border ckeditor" rows="4" name="resposta"
                        id="resposta"><?php echo $dados['resposta']; ?></textarea>

                </div>

                <div class="form-group">
                    <h6><label class="mb-0" for="chave">Palavras Chave</label></h6>
                    <input class="border border w-100 p-2" name="chave" id="chave" value="<?php echo $dados['chave'];?>"
                        placeholder="Palavra Chave">
                </div>

                <div class="form-group">

                    <h6><label class="mb-0" for="chave">Video </label></h6>                   
                    <textarea class="border border w-100 p-2" id="video" name="video"
                        rows="5" cols="33"><?php echo $dados['video'];?></textarea>
                </div>

                <input type="hidden" id="dataCadastro" name="dataCadastro" value="<?php echo $dados['datacadastro'];?>">

                <div class="form-group">
                    <h6><label class="mb-0" for="chave">Produto</label></h6>

                    <select class="custom-select" id="produto" name="produto">
                        <option><?php echo $opcaoativa ?></option>
                        <?php
                        $sql = "SELECT * FROM produto where categoria='Primario' Order by ID_produto ";
	                    $resultado = pg_query($conn, $sql);
                        while($dados = pg_fetch_array($resultado)):?>
                        <option><?php echo $dados['nomeproduto'];?></option>
                        <?php endwhile; ?>
                    </select>

                </div>

                <div class="form-group">
                    <h6><label class="mb-0" for="chave">Sub Categoria</label></h6>

                    <select class="custom-select" id="subCategoria" name="subCategoria">
                        <option><?php echo $opcaosubCategoria ?></option>
                        <?php
                        $sql = "SELECT * FROM produto where categoria='Secundario' Order by ID_produto ";
	                    $resultado = pg_query($conn, $sql);
                        while($dados = pg_fetch_array($resultado)):?>
                        <option><?php echo $dados['nomeproduto'];?></option>
                        <?php endwhile; ?>
                    </select>

                </div>

                <input type="hidden" id="usuarioCadastro" name="usuarioCadastro" value="<?php echo $usuario;?>">
                <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo $idUsuario;?>">

                <div class="mt-2">
                    <button type="submit" name="btn-editar" class="btn btn-primary mb-4"> Atualizar</button>
                    <a href="perguntas.php" class="btn btn-success mb-4" data-toggle="modal"
                        data-target="#confirmarsaida"> Lista de perguntas </a>
                </div>
            </form>

        </div>
    </div>

</div>


<?php
// Footer
include_once 'includes/footer.php';
?>