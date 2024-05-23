<?php
session_start();
include_once 'includes/header.php';
include_once '../php_action/ClassePergunta.php';
include_once '../php_action/ClasseSubcategoria.php';
include_once '../php_action/ClasseResposta_Imagem.php';
$pergunta = new Pergunta();
$subcategoria = new Subcategoria();
$imagem = new Respostaimagem();
?>


<div class="container">
    <div class="row">
        <div class="col offset-md-2 mt-4 col-lg-8">
            <p class="h1 font-weight-light">Editar Pergunta </p>
            <form name="formulario" action="" method="POST">

                <?php
                $perguntas = $pergunta->GetPergunta($_GET['id']);
                foreach ($perguntas as $perg):
                    ?>
                    <input type="hidden" name="id_pergunta" value="<?php echo $perg->id_pergunta; ?>">
                    <div class="form-group">

                        <h6> <label class="mb-0" for="pergunta">Titulo</label><br></h6>
                        <input class="border w-100 p-2" type="text" name="pergunta" id="pergunta"
                            value="<?php echo $perg->pergunta; ?>" placeholder="pergunta">

                    </div>

                    <div class="form-group">

                        <h6><label class="mb-0 " for="resposta">Resposta</label></h6>
                        <textarea class="form-control border ckeditor" rows="4" name="resposta"
                            id="resposta"><?php echo $perg->resposta; ?></textarea>

                    </div>
                    <div id="formulario-imagem" class="form-group col-12 p-0">
                        <?php
                        $imagens = $imagem->GetImagemResposta($perg->id_pergunta);
                        foreach ($imagens as $img):
                            if ($perg->id_pergunta == $img->fk_id_pergunta):

                                ?>
                                <div id="campo<?php echo $img->ordem; ?>" class="p-3 mx-auto mb-3 row"
                                    style="background-color: #f6f6f6;">
                                    <hr class="w-75 mx-auto" />
                                    <h6><label class="mb-0">Seleicone a imagem</label></h6>
                                    <input class="form-control form-control-sm mb-3" id="formFileSm" type="file" name="imagem[]"
                                        id="imagem" value="<?php $img->imagem; ?>">

                                    <input type="hidden" id="ordem" name="ordem[]" value="<?php echo $img->ordem; ?>">
                                    <input type="hidden" id="id_fk_pergunta" name="id_fk_pergunta[]"
                                        value="<?php echo $img->fk_id_pergunta; ?>">

                                    <h6><label class="mb-0">Descrição </label></h6>
                                    <input class="border border w-100 p-2 mb-3" name="descricao[]" id="descricao"
                                        placeholder="Descrição da imagem" data-role="tagsinput"
                                        value="<?php echo $img->descricao; ?>">

                                    <div class="form-floating">
                                        <h6><label class="mb-0">Resposta da imagem</label></h6>
                                        <textarea class="form-control  mb-3" name="respostaimagem[]" id="respostaimagem"
                                            placeholder="Leave a comment here" id="floatingTextarea2"
                                            style="height: 100px"><?php echo $img->resposta; ?></textarea>
                                    </div>
                                    <button id="<?php echo $img->ordem; ?>" onclick="removerCampo(<?php echo $img->ordem; ?>)"
                                        type="button" class="btn btn-outline-dark mx-auto w-25 mb-3">Excluir</button>
                                    <hr class="w-75 mx-auto">
                                </div>

                                <?php
                            endif;
                        endforeach;
                        $maior_ordem = 0;
                        if ($img->ordem > $maior_ordem):
                            $maior_ordem = $img->ordem;
                            ?>
                            <!-- <input type="hidden" id="ordemcontrole_campo" value="<?php //echo $maior_ordem; ?>"> -->
                        <?php endif; ?>
                        <script>
                            var controleCampo = <?php echo $maior_ordem; ?>;
                            function adicionarCampo() {
                                controleCampo++;
                                document.getElementById('formulario-imagem').insertAdjacentHTML(
                                    'beforeend',
                                    '<div id="campo' + controleCampo + '" class="p-3 mx-auto mb-3 row" style="background-color: #f6f6f6;">' +
                                    '<hr class="w-75 mx-auto" />' +
                                    '<h6><label class="mb-0">Seleicone a imagem</label></h6>' +
                                    '<input class="form-control form-control-sm mb-3" id="formFileSm" type="file" name="imagem[]" id="imagem">' +

                                    '<input type="hidden" id="ordem" name="ordem[]" value="' + controleCampo + '">' +
                                    '<input type="hidden" id="id_fk_pergunta" name="id_fk_pergunta[]" value="">' +

                                    '<h6><label class="mb-0">Descrição </label></h6>' +
                                    '<input class="border border w-100 p-2 mb-3" name="descricao[]" id="descricao" placeholder="Descrição da imagem" data-role="tagsinput">' +

                                    '<div class="form-floating">' +
                                    '<h6><label class="mb-0">Resposta da imagem</label></h6>' +
                                    '<textarea class="form-control  mb-3" name="respostaimagem[]" id="respostaimagem" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>' +
                                    '</div>' +
                                    '<button id="' + controleCampo + '" onclick="removerCampo(' + controleCampo + ')" type="button" class="btn btn-outline-dark mx-auto w-25 mb-3">Excluir</button>' +
                                    '<hr class="w-75 mx-auto" />' +
                                    '</div>'
                                );

                            }

                            function removerCampo(idcampo) {
                                document.getElementById('campo' + idcampo).remove();
                            }
                        </script>

                    </div>
                    <h3 class="font-weight-light mt-1 mb-3"> Inserir uma seção
                        <button onclick="adicionarCampo()" type="button" class="btn btn-outline-dark">+</button>
                    </h3>

                    <div class="form-group">
                        <h6><label class="mb-0" for="chave">Palavras Chave</label></h6>
                        <input class="border border w-100 p-2" name="chave" id="chave" value="<?php echo $perg->chave; ?>"
                            placeholder="Palavra Chave">
                    </div>

                    <div class="form-group">

                        <h6><label class="mb-0" for="chave">Video </label></h6>
                        <textarea class="border border w-100 p-2" id="video" name="video" rows="5"
                            cols="33"><?php echo $perg->video; ?></textarea>
                    </div>

                    <input type="hidden" id="dataCadastro" name="dataCadastro" value="<?php echo $perg->datacadastro; ?>">


                    <div class="form-group">
                        <h6><label class="mb-0" for="chave">Sub Categoria</label></h6>

                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="fk_id_subcategoria" id="fk_id_subcategoria">

                            <?php
                            $subcategorias = $subcategoria->GetTodasSubcategoriasVisiveis();
                            foreach ($subcategorias as $sub):
                                ?>
                                <option value="<?php echo $sub->id_subcategoria; ?>"><?php echo $sub->nomesubcategoria; ?>
                                </option>
                            <?php endforeach; ?>
                            <?php if ($perg->fk_id_subcategoria == $sub->id_subcategoria): ?>
                                <option selected value="<?php echo $sub->id_subcategoria; ?>">
                                    <?php echo $sub->nomesubcategoria; ?>
                                </option>
                            <?php endif ?>
                        </select>

                    </div>

                    <input type="hidden" id="usuarioCadastro" name="usuarioCadastro" value="<?php echo $usuario; ?>">
                    <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo $idUsuario; ?>">
                <?php endforeach; ?>
                <div class="mt-2">
                    <button type="submit" name="btn-editarpergunta" class="btn btn-primary mb-4"> Atualizar</button>
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