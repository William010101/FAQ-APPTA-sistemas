<?php
// Conexão
//include_once 'php_action/db_connect.php';
include_once 'includes/ref.php';
if(!empty($_SESSION['id_usuario'])){
	//verifica se o login foi feito e permanece na pagina
}else{
	header("Location: index.php");	
}

?>

      <!--JavaScript at end of body for optimized loading-->
<!-- Modal -->
                        <div id="confirmarsaida" class="modal fade" tabindex="-1"
                            role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado">Deseja realmente sair da página?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      As mudanças feitas nesse formulário não serão salvas. <br> Saindo desta página, todas as mudanças serão perdidas.
                                    </div>
                                    <div class="modal-footer">
                                    
                                            <a href="perguntas.php"  name="btn-deletar" class="btn btn-success">Sair</a>
                                            <button type="button" href="#!" class="btn btn-light"
                                                data-dismiss="modal">Cancelar</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="confirmarsaidacategoria" class="modal fade" tabindex="-1"
                            role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado">Deseja realmente sair da página?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      As mudanças feitas nesse formulário não serão salvas. <br> Saindo desta página, todas as mudanças serão perdidas.
                                    </div>
                                    <div class="modal-footer">
                                    
                                            <a href="categoria.php"  name="btn-deletar" class="btn btn-success">Sair</a>
                                            <button type="button" href="#!" class="btn btn-light"
                                                data-dismiss="modal">Cancelar</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div id="confirmarsaidasubcategoria" class="modal fade" tabindex="-1"
                            role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado">Deseja realmente sair da página?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      As mudanças feitas nesse formulário não serão salvas. <br> Saindo desta página, todas as mudanças serão perdidas.
                                    </div>
                                    <div class="modal-footer">
                                    
                                            <a href="subcategoria.php"  name="btn-deletar" class="btn btn-success">Sair</a>
                                            <button type="button" href="#!" class="btn btn-light"
                                                data-dismiss="modal">Cancelar</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="confirmarsaidaproduto" class="modal fade" tabindex="-1"
                            role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="TituloModalCentralizado">Deseja realmente sair da página?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      As mudanças feitas nesse formulário não serão salvas. <br> Saindo desta página, todas as mudanças serão perdidas.
                                    </div>
                                    <div class="modal-footer">
                                        
                                            <input type="hidden" name="id_pergunta"
                                                value="<?php echo $dados['id_pergunta']; ?>">
                                            <a href="produtos.php"  name="btn-deletar" class="btn btn-success">Sair</a>
                                            <button type="button" href="#!" class="btn btn-light"
                                                data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

      <script>
      	 M.AutoInit();
      	</script>
      
    </body>
  </html>