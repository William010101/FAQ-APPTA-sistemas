	<?php

	/* instancia a classe usuario */
	require_once 'usuarios.php';
	include_once 'includes/ref.php';
	$u = new Usuario;
	?>

	<html lang="pt-br">

	<head>
	    <title>Painel FAQ</title>
	    <meta charset="utf-8" />

	</head>

	<body>
	    <div class="container containerLogin">
	        <div class="row">
	            <div class="col-12 col-sm-6 text-center text-sm-right">
	                <img src="img/logoappta.png" class="mt-3  mb-3" id="logologin" alt="Logo APPTA">
	            </div>
	            <div class="col-12 col-sm-6 text-center text-sm-left">
	                <h5 class="text-uppercase mt-3 mb-3" id="title-faq">Painel FAQ</h5>
	            </div>
	        </div>

	        <div class="row">
	            <div class="col-12 col-sm-12">
	                <div class="boxLogin pl-5 pr-5">
	                    <div class="container">
	                        <form method="post">
	                            <div class="form-group">
	                                <label class="lblLogin mt-5" for="login">Login</label>
	                                <input type="text" class="form-control form-control-lg"
	                                    placeholder="Digite aqui seu login"  name="email">
	                            </div>
	                            <div class="form-group mb-0">
	                                <label class="lblLogin" for="senha">Senha</label>
	                                <input type="password" class="form-control form-control-lg"
	                                    placeholder="Digite aqui sua senha" name="senha">
	                            </div>
	                            <!-- Botao entrar -->
	                            <input class="btn" id="btnLogin" type="submit" value="ENTRAR" name="entrar">

	                            <div class="form-group">
	                                <div class="pt-1 pb-1" id="erro">
	                                    <?php			
										/*isset verifica se a variavel existe, retorna boolean */
											if(isset($_POST['email']))
											{	
												/*proteção contra SQL Injection*/

												$email=addslashes($_POST['email']);
												$senha=addslashes($_POST['senha']);

												/*verifica se o campo esta preenchido */

												if(!empty($email) && !empty($senha)){
													/*tenta a conexão com o banco*/
													$u->conectar();

													if($u->msgErro==""){
														if($u->logar($email,$senha))
														{
															header("location: perguntas.php");
														}else{
															echo "<p class='alert alert-danger' id='alerta';>Usuario ou senha incorreto!</p>";
														}
													}
												}else{
													echo "<p class='alert alert-danger' id='alerta';>Preencha todos os campos!</p>";
												}	
											} 
										?>
	                                </div>
	                            </div>
	                    </div>
	                </div>
	                </form>
	            </div>
	        </div>



	    </div>
	    <!-- div responsavel pela verificação dos campos -->




	    </div>

	</body>

	</html>

	<!-- Fechamento da mensagem de erro -->
	<script>
$("#alerta").fadeTo(2000, 200).slideUp(12, function() {
    $("#alerta").slideUp(200);
});
	</script>