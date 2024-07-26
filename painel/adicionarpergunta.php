<?php
session_start();
// Header
include_once 'includes/ref.php';
include_once 'services/PerguntaService.php';
include_once 'includes/header.php';
include_once '../php_action/ClasseSubcategoria.php';
include_once '../php_action/ClasseCategoria.php';
require_once '../php_action/ClasseUsuario.php';
$subcategoria = new Subcategoria();
$categoria = new Categoria();
$usuario = new Usuario();
$service = new PerguntaService();
$service->PostPergunta();
?>

<div class="container ">
    <div class="row ">
        <div class="col offset-md-1 mt-4 col-lg-8 mx-auto">
            <h3 class="font-weight-light mt-1 mb-3"> Cadastro E-Manual </h3>

            <form name="form1" action="" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <h6> <label class="mb-0" for="pergunta">Titulo</label><br></h6>
                    <input class="border w-100 p-2" type="text" name="pergunta" id="pergunta" placeholder="Titulo da pergunta">

                </div>
                <script>
                    //script para que se um dos selects for selecionado o outro fica vazio
                    function resetSelect(selectId) {
                        const otherSelectId = selectId === 'select1' ? 'select2' : 'select1';
                        const otherSelect = document.getElementById(otherSelectId);
                        otherSelect.selectedIndex = 0; // Reseta para o valor padrão
                    }
                </script>
                <h6> <label class="mb-0" for="pergunta">Nome da Categoria </label><br></h6>
                <h6 class="text-danger">A categoria só deve ser selecionada caso a pergunta não tenha uma subcategoria</h6>
                <select class="form-select mb-3" id="select1" onchange="resetSelect('select1')" aria-label="Floating label select example" name="fk_id_categoria" id="fk_id_categoria" required>
                    <option selected>Selecione </option>
                    <?php
                    $categorias = $categoria->GetTodasCategorias();
                    foreach ($categorias as $cat) :
                    ?>
                        <option value="<?php echo $cat->id_categoria; ?>"><?php echo $cat->nomecategoria; ?></option>
                    <?php endforeach; ?>
                </select>
                <h6> <label class="mb-0" for="pergunta">Nome da Subcategoria </label><br></h6>

                <select class="form-select mb-3" id="select2" onchange="resetSelect('select2')" aria-label="Floating label select example" name="fk_id_subcategoria" id="fk_id_subcategoria" required>
                    <option selected>Selecione </option>
                    <?php
                    $subcategorias = $subcategoria->GetTodasSubcategorias();
                    foreach ($subcategorias as $sub) :
                    ?>
                        <option value="<?php echo $sub->id_subcategoria; ?>"><?php echo $sub->nomesubcategoria; ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="form-group">

                    <h6><label class="mb-0" for="chave">Chave </label></h6>
                    <input class="border border w-100 p-2" name="chave" id="chave" placeholder="Palavra Chave" data-role="tagsinput">

                </div>

                <div class="form-group">
                    <h6><label class="mb-0 " for="resposta">Resposta</label></h6>
                    <textarea class="form-control border ckeditor" rows="4" name="resposta" id="resposta"></textarea>

                </div>


                <div id="formulario-imagem" class="form-group col-12 p-0">

                </div>
                <h3 class="font-weight-light mt-1 mb-3"> Inserir uma seção
                    <button onclick="adicionarCampo()" type="button" class="btn btn-outline-dark">+</button>
                </h3>

                <div class="form-group">
                    <h6><label class="mb-0 " for="resposta">Solução</label></h6>
                    <textarea class="form-control border ckeditor" rows="4" name="solucao" id="resposta"></textarea>
                </div>

                <div class="form-group">
                
                <h6><label class="mb-0" for="video">Video </label></h6>
                <h6>Atenção!</h6>
                <p>Substitua o valor do "width" por "100%", deve ficar como width="100%"</p>    
                    <input class="border border w-100 p-2" id="video" name="video" placeholder="Cole aqui o código de incorporação do vídeo"></in>
                </div>



                <input type="hidden" id="dataCadastro" name="dataCadastro" value="<?php
                                                                                    date_default_timezone_set('America/Sao_Paulo');
                                                                                    $data = new DateTime();
                                                                                    echo $data->format('d-m-Y H:i:s');
                                                                                    ?>">

                <?php
                $usuarios = $usuario->GetUsuario($_SESSION['id_usuario']);
                foreach ($usuarios as $user) :
                ?>

                    <input type="hidden" id="usuarioCadastro" name="usuarioCadastro" value="<?php echo $user->nome; ?>">
                    <input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo $user->id_usuario; ?>">

                <?php endforeach; ?>
                <div class="custom-control custom-checkbox mt-4">
                    <input type="checkbox" class="custom-control-input" id="customControlValidation1" name="visivel" value="1">
                    <label class="custom-control-label" for="customControlValidation1">Mostrar Pergunta no site!</label>
                </div>
                <script>
                    var controleCampo = 0;

                    function adicionarCampo() {
                        controleCampo++;
                        document.getElementById('formulario-imagem').insertAdjacentHTML(
                            'beforeend',
                            '<div id="campo' + controleCampo + '" class="p-3 mx-auto mb-3 row" style="background-color: #f6f6f6;">' +
                            '<hr class="w-75 mx-auto" />' +
                            '<h6 class="text-danger text-center">Atenção ao selecionar a imagem, não apague antes de cadastrar a pergunta.</h6>' +
                            '<h6><label class="mb-0">Seleicone a imagem(imagem em PNG)</label></h6>' +
                            '<input required class="form-control form-control-sm mb-3" id="formFileSm" type="file" name="imagem[]" accept=".png" id="imagem">' +

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
                        document.getElementById('cadastrar-btn').style.display = 'none';
                        document.getElementById('validarImagens').style.display = 'inline-block';

                    }

                    function removerCampo(idcampo) {
                        if (confirm("Tem certeza de que deseja excluir esta seção?")) {
                            document.getElementById('campo' + idcampo).remove();
                        }
                    }
                </script>
                <button type="button" id="validarImagens" class="btn btn-primary mb-4 mt-4" style="display: inline-block;">Validar</button>

                <button type="submit" name="btn-cadastrar-pergunta" class="btn btn-primary mb-4 mt-4" style="display: none;" id="cadastrar-btn">
                    Cadastrar
                </button>
                <a href="faq.php" class="btn btn-success mb-4 mt-4" data-toggle="modal" data-target="#confirmarsaida" id="voltar"> Lista de perguntas </a>

            </form>
            <div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validação ao clicar no botão "Validar"
            document.getElementById('validarImagens').addEventListener('click', function() {
                validateImages();
            });

            // Monitorando mudanças no input de arquivo
            const inputFiles = document.querySelectorAll('input[type="file"][name="imagem[]"]');
            inputFiles.forEach(inputFile => {
                inputFile.addEventListener('change', function() {
                    // Limpa a mensagem de validação ao alterar o input
                    this.setCustomValidity(''); // Limpa a mensagem de erro padrão
                });
            });
        });

        // Função para validar as imagens
        function validateImages() {
            const inputFiles = document.querySelectorAll('input[type="file"][name="imagem[]"]');
            let allValid = true;

            inputFiles.forEach(inputFile => {
                const files = inputFile.files;

                if (files.length === 0) {
                    alert('Nenhuma imagem selecionada para esse campo.');
                    allValid = false;
                } else {
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        if (file.size === 0) {
                            alert(`A imagem ${file.name} está vazia.`);
                            allValid = false;
                        }
                    }
                }
            });

            if (allValid) {
                alert('Todas as imagens são válidas!');
                document.getElementById('cadastrar-btn').style.display = 'inline-block';
                document.getElementById('validarImagens').style.display = 'none';
            }
        }
    </script>
</div>

<?php
// Footer
include_once 'includes/footer.php';
?>