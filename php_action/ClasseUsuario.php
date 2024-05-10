<?php
require_once '../php_action/ClasseConnection.php';
	Class Usuario
	{
		public int $id_usuario;
		public string $nome;
		private string $senha;
		private string $email;
		public string $fotoperfil;
		private $Conexao;
		public function __construct(){
			$this->Conexao = new Conexao();
		}

		public function GetUsuario($idusuario)
		{
			try
			{
				$pdo = $this->Conexao->getPdo();
				$query = "SELECT * FROM usuarios WHERE id_usuario = :idusuario";
				$stmt = $pdo->prepare($query);
				$stmt->bindParam(':idusuario', $idusuario, PDO::PARAM_INT);
				$stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'Usuario');
				return $stmt->fetchAll();
			}catch (PDOException $e) {
				throw new PDOException($e->getMessage(), (int)$e->getCode());
			}
			
		}

		public function logar($email,$senha){

			$pdo = $this->Conexao->getPdo();
			//verificar se o email e senha estao cadastrados
			$stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email= :e AND senha = :s");
			$stmt->bindValue(":e",$email);
			$stmt->bindValue(":s",$senha);
			$stmt->execute();
			if($stmt->rowCount()>0)
			{
				// entrar no sistema(sessao)
				$dados =  $stmt->fetch();
				session_start();
				$_SESSION['id_usuario'] = $dados['id_usuario'];
					return true; // logado com sucesso
				}else{
					return false; // não foi possivel logar
				}
			}

		}
	
?>