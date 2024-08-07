<?php
session_start();
include_once 'includes/header.php';
include_once '../php_action/ClasseSubcategoria.php';
include_once '../php_action/ClasseConnection.php';
$subcategoria = new Subcategoria();
$subcategoria->DeletarSubcategoria();
?>
<?php include_once 'includes/menufaq.php'; ?>

<div class="container-fluid">

    <div class="row">
        <div class="col offset-md-2 mt-4 col-lg-8">

            <h3 class="font-weight-light">FAQ - Lista de subcategorias </h3>

            <input class="form-control" id="pesquisa" type="text" placeholder="Pesquisar..">
                        
            <a href="adicionarsubcategoria.php" class="btn btn-primary mb-4 mt-4">ADICIONAR SUBCATEGORIA</a>
            <a href="sair.php" class="btn btn-danger ml-1  mb-4 mt-4">SAIR</a>
            <table class="table table-hover mt-3">
                <thead class="thead-light">
                    <tr>
                        <th>Nome da subcategoria</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>

                <tbody id="tabela">
                    <?php
                        $subcategorias = $subcategoria->GetTodasSubcategorias();
                        foreach ($subcategorias as $sub):
                    ?>

                    <tr>

                        <td width="50%" data-toggle="collapse" href="#collapse<?php echo $sub->id_subcategoria; ?>">
                            <?php echo $sub->nomesubcategoria; ?>
                            <div class="collapse" id="collapse<?php echo $sub->id_subcategoria; ?>">
                            <div class="">

                                <?php if ($sub->visivel == 'true') 
                                    {
                                        echo '<div class="text-success">Categoria visivel no site!</div>';
                                    }else {
                                        echo '<div class="text-danger">Categoria ocultado do site!</div>';
                                    } 
                                ?>

                                </div>
                            </div>
                        </td>

                        <td>
                            <a href="editarsubcategoria.php?id=<?php echo $sub->id_subcategoria; ?>"
                                class="btn btn-warning"><i class="material-icons">edit</i>
                            </a>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger btn_del" data-toggle="modal"
                                data-target="#modal<?php echo $sub->id_subcategoria; ?>">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>

                        <!-- Collapse -->


                        <!-- Modal -->
                        <div id="modal<?php echo $sub->id_subcategoria; ?>" class="modal fade" tabindex="-1"
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
                                        Tem certeza que deseja deletar esse produto?
                                    </div>

                                    <div class="modal-footer">
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_subcategoria"
                                            value="<?php echo $sub->id_subcategoria; ?>">

                                            <button type="submit" name="btn-deletar-subcategoria" class="btn btn-danger">Sim,
                                                quero
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


                        <?php 
                            endforeach;
                        ?>
                </tbody>
            </table>
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

