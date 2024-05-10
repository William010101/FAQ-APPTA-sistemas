<?php
session_start();
// Header
include_once 'includes/ref.php';
include_once 'includes/header.php';
include_once '../php_action/ClasseSubcategoria.php';
include_once '../php_action/ClasseConnection.php';
require_once '../php_action/ClasseUsuario.php';
$subcategoria = new Subcategoria();
$usuario = new Usuario();
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

                <div  id="formulario-imagem" class="form-group col-12 p-0">

                </div>
                <h3 class="font-weight-light mt-1 mb-3"> Inserir uma seção <button onclick="adicionarCampo()" type="button" class="btn btn-outline-dark">+</button></h3>

                <script>
                var controleCampo = 0;
                function adicionarCampo(){
                    controleCampo++;
                    document.getElementById('formulario-imagem').insertAdjacentHTML(
                    'beforeend', 
                    '<div id="campo'+controleCampo+'" class="w-100 p-2 mb-3" style="background-color: #f6f6f6;">'+
                    '<hr />'+
                    '<h6><label class="mb-0">Seleicone a imagem</label></h6>'+
                    '<input class="form-control form-control-sm mb-3" id="formFileSm" type="file" name="imagem" id="imagem">'+

                    '<input type="hidden" id="ordem" name="ordem" value="'+controleCampo+'">'+

                    '<h6><label class="mb-0">Descrição </label></h6>'+
                    '<input class="border border w-100 p-2 mb-3" name="descricao" id="descricao" placeholder="Descrição da imagem" data-role="tagsinput">'+
            
                    '<div class="form-floating">'+
                    '<h6><label class="mb-0">Resposta da imagem</label></h6>'+
                    '<textarea class="form-control  mb-3" name="respostaimagem" id="respostaimagem" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>'+
                    '</div>'+         
                    '<button id="'+controleCampo+'" onclick="removerCampo('+controleCampo+')" type="button" class="btn btn-outline-dark mx-auto">Excluir</button>'+
                    '<hr />'+
                    '</div>'
                    );
                      
                }

                function removerCampo(idcampo){
                    document.getElementById('campo'+idcampo).remove();
                }
                </script>
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
                        $usuarios = $usuario->GetUsuario($_SESSION['id_usuario']);
                        foreach($usuarios as $user):
                ?>

                <input type="hidden" id="usuarioCadastro" name="usuarioCadastro" value="<?php echo $user->nome;?>">
                <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo $user->id_usuario;?>">
                <?php endforeach; ?>
                <button type="submit" name="btn-cadastrar-pergunta" class="btn btn-primary mb-4 mt-4"> Cadastrar </button>
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