<?php
session_start();
include_once 'includes/header.php';
include_once 'services/PerguntaService.php';
include_once '../php_action/ClassePergunta.php';
include_once '../php_action/ClasseSubcategoria.php';
include_once '../php_action/ClasseCategoria.php';
include_once '../php_action/ClasseResposta_Imagem.php';
$pergunta = new Pergunta();
$subcategoria = new Subcategoria();
$categoria = new Categoria();
$imagem = new Respostaimagem();
$service = new PerguntaService();
?>


<div class="container">
    <div class="row">
        <div class="col offset-md-2 mt-4 col-lg-8">
            <p class="h1 font-weight-light">Editar Pergunta </p>
            <form name="formulario" action="" method="POST" enctype="multipart/form-data">

                <?php
                $perguntas = $pergunta->GetPergunta($_GET['id']);
                foreach ($perguntas as $perg):

                    ?>
                                <input type="hidden" name="id_pergunta" value="<?php echo $perg->id_pergunta; ?>">
                                <input type="hidden" name="id_pergunta" value="<?php echo $perg->fk_id_categoria;?>">
                                <div class="form-group">

                                    <h6> <label class="mb-0" for="pergunta">Titulo</label><br></h6>
                                    <input class="border w-100 p-2" type="text" name="pergunta" id="pergunta"
                                        value="<?php echo $perg->pergunta; ?>" placeholder="pergunta">

                                </div>
                                <div class="form-group">
                                    <h6><label class="mb-0" for="chave">SubCategoria</label></h6>

                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="fk_id_subcategoria" id="fk_id_subcategoria">
                                    <option >Selecione </option>
                                        <?php
                                        $subcategorias = $subcategoria->GetTodasSubcategoriasVisiveis();
                                        foreach ($subcategorias as $sub):
                                            ?>
                                            <?php if ($perg->fk_id_subcategoria == $sub->id_subcategoria): ?>
                                                <option selected value="<?php echo $sub->id_subcategoria; ?>">
                                                    <?php echo $sub->nomesubcategoria; ?>
                                                </option>
                                            <?php endif; ?>
                                                <option value="<?php echo $sub->id_subcategoria; ?>"><?php echo $sub->nomesubcategoria; ?></option>                                           
                                        <?php endforeach; ?>
                                        
                                    </select>

                                    <h6> <label class="mb-0" for="pergunta"> Categoria </label><br></h6>
                                    
                                    <select class="form-select mb-3" id="floatingSelect" aria-label="Floating label select example"
                                        name="fk_id_categoria" id="fk_id_categoria" required>
                                        <option >Selecione </option>
                                        <?php $categorias = $categoria->GetTodasCategorias(); 
                                        foreach ($categorias as $cat):?>
                                        <?php if($perg->fk_id_categoria == $cat->id_categoria):?>
                                        <option selected value="<?php echo $cat->id_categoria ?>"><?php echo $cat->nomecategoria;?></option>
                                        <?php endif?>
                                        <option value="<?php echo $cat->id_categoria ?>"><?php echo $cat->nomecategoria; ?></option>
                                        <?php endforeach; ?>
                                             
                                    </select>

                                </div>
                                <div class="form-group">
                                    <h6><label class="mb-0" for="chave">Palavras Chave</label></h6>
                                    <input class="border border w-100 p-2" name="chave" id="chave" value="<?php echo $perg->chave; ?>"
                                        placeholder="Palavra Chave">
                                </div>
                                <div class="form-group">

                                    <h6><label class="mb-0 " for="resposta">Resposta</label></h6>
                                    <textarea class="form-control border ckeditor" rows="4" name="resposta"
                                        id="resposta"><?php echo $perg->resposta; ?></textarea>

                                </div>
                                <div id="formulario-imagem" class="form-group col-12 p-0">
                                    <?php
                                    $imagens = $imagem->GetImagemRespostaPergunta($perg->id_pergunta);
                                    foreach ($imagens as $img):
                                        if ($perg->id_pergunta == $img->fk_id_pergunta):

                                            ?>
                                                               <div id="campo<?php echo $img->ordem; ?>" class="p-3 mx-auto mb-3 row"
                                                                    style="background-color: #f6f6f6;">
                                                                    <hr class="w-75 mx-auto" />
                                                                    <h6><label class="mb-0" for="imagem">Imagem atual:</label><br></h6>
                                                                    <img class="mb-3 mx-auto w-50 h-50"
                                                                            src="data:image/png;base64,<?php echo base64_encode($img->imagem); ?>"
                                                                            alt="Imagem do Produto">
                                                                        <h6><label class="mb-0">Seleiconar nova imagem</label></h6>
                                                                        <input class="form-control form-control-sm mb-3" id="formFileSm" type="file"
                                                                            name="nova_imagem[]" id="imagem">

                                                            
                                                                        <input type="hidden" id="idrespostaimagem" name="idrespostaimagem[]"
                                                                            value="<?php echo $img->id_respostaimagem; ?>">
                                                                        <input type="hidden" id="id_fk_pergunta" name="id_fk_pergunta[]"
                                                                            value="<?php echo $img->fk_id_pergunta; ?>">

                                                                        <h6><label class="mb-0">Descrição </label></h6>
                                                                        <input class="border border w-100 p-2 mb-3" name="descricaocad[]" id="descricao"
                                                                            placeholder="Descrição da imagem" data-role="tagsinput"
                                                                            value="<?php echo $img->descricao; ?>">

                                                                        <div class="form-floating">
                                                                            <h6><label class="mb-0">Resposta da imagem</label></h6>
                                                                            <textarea class="form-control  mb-3" name="respostaimagemcad[]" id="respostaimagem"
                                                                                placeholder="Leave a comment here" id="floatingTextarea2"
                                                                                style="height: 100px"><?php echo $img->resposta; ?></textarea>
                                                                        </div>
                                                                        <h6><label class="mb-0">Ordem da seção</label></h6>
                                                                        <input class="border border w-100 p-2 mb-3" id="ordem" name="ordemcad[]" value="<?php echo $img->ordem; ?>">
                                                                        <button onclick="excluirSecao(<?php echo $img->id_respostaimagem; ?>)" type="button" class="btn btn-outline-dark mx-auto w-25 mb-3" name="deletar-secao">Excluir</button>
                                                                        <hr class="w-75 mx-auto">                                                     
                                                                    </div>
                                                                    <!-- Modal -->

                                            <?php
                                        endif;
                                    endforeach;

                                    $maior_ordem = 0;
                                    if (isset($img->ordem) && $img->ordem > $maior_ordem):
                                        $maior_ordem = $img->ordem;
                                        ?>
                                    <?php endif; ?>
                                    <script>
                                        var controleCampo = <?php
                                        if (!isset($maior_ordem)) {
                                            echo $maior_ordem;
                                        } else {
                                            echo 0;
                                        }
                                        ?>;
                                        var fkidpergunta = <?php echo $perg->id_pergunta ?>;
                                        function adicionarCampo() {
                                            controleCampo++;
                                            document.getElementById('formulario-imagem').insertAdjacentHTML(
                                                'beforeend',
                                                '<div id="campo' + controleCampo + '" class="p-3 mx-auto mb-3 row" style="background-color: #f6f6f6;">' +
                                                '<hr class="w-75 mx-auto" />' +
                                                '<h6><label class="mb-0">Seleicone a imagem</label></h6>' +
                                                '<input class="form-control form-control-sm mb-3" id="formFileSm" type="file" name="imagem[]" id="imagem">' +

                                                '<input type="hidden" id="ordem" name="ordem[]" value="' + controleCampo + '">' +
                                                '<input type="hidden" id="id_fk_pergunta" name="id_fk_pergunta[]" value="' + fkidpergunta + '">' +

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
                                            if (confirm("Tem certeza de que deseja excluir esta seção?")) {
                                            document.getElementById('campo' + idcampo).remove();
                                            }
                                        }

                                    
                                        function excluirSecao(idRespostaImagem) {
        // Confirmar a exclusão antes de enviar a solicitação
                                            if (confirm("Tem certeza de que deseja excluir esta seção?")) {
                                                // Enviar uma solicitação Fetch para PerguntaService.php
                                                fetch("services/PerguntaService.php", {
                                                    method: "POST",
                                                    headers: {
                                                        "Content-Type": "application/x-www-form-urlencoded"
                                                    },
                                                    body: new URLSearchParams({
                                                        idrespostaimagem: idRespostaImagem,
                                                        'deletar-secao': "deletar" // Passar o atributo 'deletar-secao'
                                                    })
                                                })
                                                .then(response => {
                                                    if (!response.ok) {
                                                        throw new Error('Erro na rede');
                                                    }
                                                    return response.text();
                                                })
                                                .then(data => {
                                                    // Lidar com a resposta do servidor
                                                    alert("Seção excluída com sucesso!");
                                                    // Recarregar a página ou fazer outras atualizações necessárias
                                                    location.reload(); // Recarrega a página após a exclusão
                                                })
                                                .catch(error => {
                                                    // Lidar com erros de solicitação
                                                    alert("Ocorreu um erro ao tentar excluir a seção.");
                                                    console.error(error);
                                                });
                                            }
                                        }

                                    

                                    </script>

                                </div>
                                <h3 class="font-weight-light mt-1 mb-3"> Inserir uma seção
                                    <button onclick="adicionarCampo()" type="button" class="btn btn-outline-dark">+</button>
                                </h3>



                                <div class="form-group">

                                    <h6><label class="mb-0" for="chave">Video </label></h6>
                                    <textarea class="border border w-100 p-2" id="video" name="video" rows="5"
                                        cols="33"><?php echo $perg->video; ?></textarea>
                                </div>

                                <input type="hidden" id="dataCadastro" name="dataCadastro" value="<?php echo $perg->datacadastro; ?>">

                                <?php if ($perg->visivel == true): ?>
                                                <div class="custom-control custom-checkbox mt-4">
                                                    <input type="checkbox" class="custom-control-input" checked id="customControlValidation1" name="visivel">
                                                    <label class="custom-control-label" for="customControlValidation1">Exibir pergunta no site?</label>
                                                </div>
                                <?php else: ?>
                                                <div class="custom-control custom-checkbox mt-4">
                                                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel">
                                                    <label class="custom-control-label" for="customControlValidation1">Exibir pergunta no site?</label>
                                                </div>
                                <?php endif; ?>
                                <input type="hidden" id="usuarioCadastro" name="usuarioCadastro" value="<?php echo $perg->usuario; ?>">
                                <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo $perg->idusuario; ?>">
                <?php endforeach; ?>
                <div class="mt-2">
                    <button type="submit" name="btn-editarpergunta" class="btn btn-primary mb-4"> Atualizar</button>
                    <a href="perguntas.php" class="btn btn-success mb-4" data-toggle="modal"
                        data-target="#confirmarsaida"> Lista de perguntas </a>
                </div>
            </form>
        </div>
        <?php echo $service->SetPergunta(); ?>
    </div>

</div>


<?php
// Footer
include_once 'includes/footer.php';
?>