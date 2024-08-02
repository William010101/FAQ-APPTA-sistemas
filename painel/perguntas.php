<?php
session_start();
// Conexão
include_once 'includes/header.php';
include_once 'services/PerguntaService.php';
include_once '../php_action/ClasseSubcategoria.php';
include_once '../php_action/ClasseCategoria.php';
include_once '../php_action/ClassePergunta.php';
include_once '../php_action/ClasseConnection.php';
$pergunta = new Pergunta();
$subcategoria = new Subcategoria();
$categoria = new Categoria();
$service = new PerguntaService();
$service->DeletarPergunta();
?>

<?php include_once 'includes/menufaq.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col offset-md-2 mt-4 col-lg-8">

            <h3 class="font-weight-light">FAQ - Lista de perguntas</h3>

            <input class="form-control" id="pesquisa" type="text" placeholder="Pesquisar..">
            <a href="adicionarpergunta.php" class="btn btn-primary mb-4 mt-4">ADICIONAR PERGUNTA</a>
            <a href="sair.php" class="btn btn-danger ml-1  mb-4 mt-4">SAIR</a>
            <table class="table table-hover mt-3 ">
                <thead class="thead-light ">
                    <tr>
                        <th>Pergunta</th>
                        <th>Subcategoria</th>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>

                <tbody id="tabela">
                    <?php
                    $perguntas = $pergunta->GetTodasPerguntas();
                    $contador = 0;
                    foreach ($perguntas as $perg):                       
                        $contador++; 
                        ?>
                        <tr>

                        <td width="42%" data-toggle="collapse" href="#collapse<?php echo $perg->id_pergunta; ?>">
                                <?php echo "<strong>".$contador."</strong>"." - ". $perg->pergunta; ?>
                                <div class="collapse" id="collapse<?php echo $perg->id_pergunta; ?>">
                                    <div class="">

                                        <?php if ($perg->visivel == 'true') {
                                            echo '<div class="text-success">Pergunta visivel no site!</div>';
                                        } else {
                                            echo '<div class="text-danger">Pergunta ocultada do site!</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </td>
                                
                                <td width="22%">
                                    <?php
                                $subcategorias = $subcategoria->GetTodasSubcategorias();
                                foreach ($subcategorias as $sub):
                                    ?>
                                   <?php
                                   if ($perg->fk_id_subcategoria == $sub->id_subcategoria) {
                                       echo $sub->nomesubcategoria;
                                   }
                                   ?>
                                  <?php endforeach; ?>
                                </td>
                                <td width="22%">
                                    <?php
                                $categorias = $categoria->GetTodasCategorias();
                                foreach ($categorias as $cat):
                                    ?>
                                   <?php
                                   if ($perg->fk_id_categoria == $cat->id_categoria) {
                                       echo $cat->nomecategoria;
                                   }
                                   ?>
                                  <?php endforeach; ?>
                                </td>
                            
                            <td ><a href="editarpergunta.php?id=<?php echo $perg->id_pergunta; ?>" class="btn btn-warning"><i
                                        class="material-icons">edit</i></a></td>

                            <td>
                                <button type="button" class="btn btn-danger btn_del" data-toggle="modal"
                                    data-target="#modal<?php echo $perg->id_pergunta; ?>">
                                    <i class="material-icons">delete</i>
                                </button>
                            </td>

                            <!-- Modal -->
                            <div id="modal<?php echo $perg->id_pergunta; ?>" class="modal fade" tabindex="-1"
                                role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="TituloModalCentralizado">Excluir</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            Tem certeza que deseja deletar essa pergunta?
                                        </div>

                                        <div class="modal-footer">
                                            <form action="" method="POST">
                                                <input type="hidden" name="id_pergunta"
                                                    value="<?php echo $perg->id_pergunta; ?>">

                                                <button type="submit" name="btn-deletar-pergunta" class="btn btn-danger">Sim, quero
                                                    deletar!
                                                </button>

                                                <button type="button" href="#!" class="btn btn-light"
                                                    data-dismiss="modal">Cancelar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php endforeach; ?>
                </tbody>
            </table>

            <br>

        </div>
    </div>

</div>

</div>

<!-- javascript para pesquisar dentro da tabela -->

<script>
$(document).ready(function() {
    $("#pesquisa").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabela tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>


<?php
// Footer
include_once 'includes/footer.php';
?>