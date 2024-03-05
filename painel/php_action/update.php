<?php
// Sessão
session_start();
// Conexão
require_once 'db_connect.php';



if(isset($_POST['btn-editar'])):
	$pergunta = pg_escape_string($conn, $_POST['pergunta']);
	$resposta = pg_escape_string($conn, $_POST['resposta']);
	$chave =pg_escape_string($conn, $_POST['chave']);
	$produto =pg_escape_string($conn, $_POST['produto']);
	$dataCadastro =pg_escape_string($conn, $_POST['dataCadastro']);
	$video = pg_escape_string($conn, $_POST['video']);
	$subCategoria = pg_escape_string($conn, $_POST['subCategoria']);
	$usuario = pg_escape_string($conn, $_POST['usuarioCadastro']);
	$idUsuario = pg_escape_string($conn, $_POST['usuarioId']);
	$id = pg_escape_string($conn, $_POST['id_pergunta']);
	if($resposta==null){

	$sql = "UPDATE pergunta SET pergunta = '$pergunta', resposta = null, chave = '$chave', produto = '$produto', dataCadastro = '$dataCadastro', video= '$video', subCategoria = '$subCategoria', usuario = '$usuario', idUsuario = '$idUsuario' WHERE id_pergunta = '$id'";
	}else{
		$sql = "UPDATE pergunta SET pergunta = '$pergunta', resposta = '$resposta', chave = '$chave', produto = '$produto', dataCadastro = '$dataCadastro', video= '$video',  subCategoria = '$subCategoria',  usuario = '$usuario', idUsuario = '$idUsuario' WHERE id_pergunta = '$id'";
	}
	if(pg_query($conn, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: ../perguntas.php');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar";
		
	endif;
endif;



if(isset($_POST['btn-editar-produto'])):
	$nomeproduto = pg_escape_string($conn, $_POST['nomeproduto']);
	$categoria = pg_escape_string($conn, $_POST['categoria']);
	$customControlValidation1 =pg_escape_string($conn, $_POST['visivel']);

	$id = pg_escape_string($conn, $_POST['id_produto']);
	if($customControlValidation1 == "on"){
		
	$sqlproduto = "UPDATE PRODUTO SET categoria = '$categoria', nomeproduto = '$nomeproduto', visivel = 'true' WHERE id_produto = '$id'";
	}else{
	
	$sqlproduto= "UPDATE PRODUTO SET categoria = '$categoria', nomeproduto = '$nomeproduto', visivel = 'false' WHERE id_produto = '$id'";
	}
	if(pg_query($conn, $sqlproduto)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: ../produtos.php');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar";
	endif;
endif;