<?php
session_start();
// Conexão
include_once 'php_action/db_connect.php';
// Header
include_once 'includes/header.php';

//CONTAR REGISTROS
$contador = "SELECT id_pergunta,
(SELECT COUNT(*) FROM pergunta ) AS total FROM pergunta";
$registros = pg_query($conn, $contador);
$dadoscontador = pg_fetch_array($registros);

?>

<?php include_once 'includes/menufaq.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col offset-md-2 mt-4 col-lg-8">

            <h3 class="font-weight-light">FAQ - Lista de perguntas</h3>

            <input class="form-control" id="pesquisa" type="text" placeholder="Pesquisar..">
            <a href="adicionar.php" class="btn btn-primary mb-4 mt-4">ADICIONAR PERGUNTA</a>
            <a href="sair.php" class="btn btn-danger ml-1  mb-4 mt-4">SAIR</a>
            <table class="table table-hover mt-3">
                <thead class="thead-light">
                    <tr>
                        <th>Pergunta</th>
                        <th>Produto</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>

                <tbody id="tabela">

                    <?php
                        $sql = "SELECT * FROM pergunta ORDER BY
                        id_pergunta ASC";
                        $resultado = pg_query($conn, $sql);            
                    
                        if(pg_num_rows($resultado) > 0):

                            while($dados = pg_fetch_array($resultado)):
                    ?>

                    <tr>

                        <td width="50%" data-toggle="collapse" href="#collapse<?php echo $dados['id_pergunta']; ?>">
                            <?php echo $dados['pergunta']; ?>
                            <div class="collapse" id="collapse<?php echo $dados['id_pergunta']; ?>">
                                <div class="">

                                    <?php if ($dados['resposta'] == "") {                                        
                                            echo '<div class="text-danger">Resposta ainda não cadastrada!</div>';
                                                }else {
                                            echo '<div class="text-success">Resposta cadastrada!</div>';
                                            } 
                                    ?>
                                </div>
                            </div>
                        </td>

                        <td width="18%"><?php echo $dados['produto']; ?></td>
                        <td><a href="editar.php?id=<?php echo $dados['id_pergunta']; ?>" class="btn btn-warning"><i
                                    class="material-icons">edit</i></a></td>

                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#modal<?php echo $dados['id_pergunta']; ?>">
                                <i class="material-icons">delete</i>
                            </button>
                        </td>

                        <!-- Modal -->
                        <div id="modal<?php echo $dados['id_pergunta']; ?>" class="modal fade" tabindex="-1"
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
                                        <form action="php_action/delete.php" method="POST">
                                            <input type="hidden" name="id_pergunta"
                                                value="<?php echo $dados['id_pergunta']; ?>">

                                            <button type="submit" name="btn-deletar" class="btn btn-danger">Sim, quero
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
                                endwhile;
                                else: 
                        ?>
                        <!-- TABELA VAZIA -->
                        <thead>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </thead>

                        <?php 
                            endif;
                        ?>

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