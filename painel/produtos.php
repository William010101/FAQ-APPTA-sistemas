<?php
session_start();
include_once 'includes/header.php';
include_once '../php_action/ClasseProduto.php';
include_once '../php_action/ClasseConnection.php';
$produto = new Produto();
$produto->DeletarProduto();
?>

<?php include_once 'includes/menufaq.php'; ?>

<div class="container-fluid">

    <div class="row">
        <div class="col offset-md-2 mt-4 col-lg-8">

            <h3 class="font-weight-light">FAQ - Lista de produtos </h3>

            <input class="form-control" id="pesquisa" type="text" placeholder="Pesquisar..">

            <table class="table table-hover mt-3">
                <thead class="thead-light">
                    <tr>
                        <th>Nome do produto</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>

                <tbody id="tabela">
                    <?php
                        $produtos = $produto->GetProdutos();
                        foreach ($produtos as $prod):
                    ?>

                    <tr>

                        <td width="50%" data-toggle="collapse" href="#collapse<?php echo $prod->id_produto; ?>">
                            <?php echo $prod->nomeproduto; ?>
                            <div class="collapse" id="collapse<?php echo $prod->id_produto; ?>">
                                <div class="">

                                    <?php if ($prod->visivel == 'true') 
                                        {
                                            echo '<div class="text-success">Produto visivel no site!</div>';
                                        }else {
                                            echo '<div class="text-danger">Produto ocultado do site!</div>';
                                        } 
                                    ?>
                                </div>
                            </div>
                        </td>

                        <td>
                            <a href="editarproduto.php?id=<?php echo $prod->id_produto; ?>"
                                class="btn btn-warning"><i class="material-icons">edit</i>
                            </a>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#modal<?php echo $prod->id_produto; ?>">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>

                        <!-- Collapse -->


                        <!-- Modal -->
                        <div id="modal<?php echo$prod->id_produto; ?>" class="modal fade" tabindex="-1"
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
                                            <input type="hidden" name="id_produto"
                                            value="<?php echo $prod->id_produto; ?>">

                                            <button type="submit" name="btn-deletar-produto" class="btn btn-danger">Sim,
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

            <br>
            <a href="adicionarproduto.php" class="btn btn-primary mb-4">ADICIONAR PRODUTO</a>
            <a href="sair.php" class="btn btn-danger ml-1  mb-4">SAIR</a>

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