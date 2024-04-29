<?php


	Class Usuario
	{
		private $pdo;
		public $msgErro = "";
		//metodo fazer conexao com banco
		public function conectar(){
			global $pdo;
			try
			{	
				$pdo = new PDO("pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=masterkey");
			} catch (PDOException $e){
				throw new PDOException($e);
			}
		}

		public function logar($email,$senha){

			global $pdo;

			//verificar se o email e senha estao cadastrados
			$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email= :e AND senha = :s");
			$sql->bindValue(":e",$email);
			$sql->bindValue(":s",$senha);
			$sql->execute();
			if($sql->rowCount()>0)
			{
				// entrar no sistema(sessao)
				$dados =  $sql->fetch();
				session_start();
				$_SESSION['id_usuario'] = $dados['id_usuario'];
					return true; // logado com sucesso
				}else{
					return false; // não foi possivel logar
				}
			}

		}
	
?>