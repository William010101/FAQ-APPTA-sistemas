<?php
// Sessão
session_start();
// Conexão
require_once 'db_connect.php';

if(isset($_POST['btn-deletar'])):
	
	$id = pg_escape_string($conn, $_POST['id_pergunta']);

	$sql = "DELETE FROM pergunta WHERE id_pergunta = '$id'";

	if(pg_query($conn, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: ../perguntas.php');
	else:
		$_SESSION['mensagem'] = "Erro ao deletar";
		header('Location: ../perguntas.php');
	endif;

endif;


if(isset($_POST['btn-deletar-produto'])):
	
	$idproduto = pg_escape_string($conn, $_POST['id_produto']);

	$sqlproduto = "DELETE FROM produto WHERE id_produto = '$idproduto'";

	if(pg_query($conn, $sqlproduto)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: ../produtos.php');
	else:
		$_SESSION['mensagem'] = "Erro ao deletar";
		header('Location: ../produtos.php');
	endif;

endif;