<?php
// Sessão
session_start();
// Conexão
require_once 'db_connect.php';
// Clear
function clear($input) {
	global $conn;
	// sql
	$var = pg_escape_string($conn, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}


if(isset($_POST['btn-cadastrar'])):
	$pergunta = clear($_POST['pergunta']);
	$resposta = ($_POST['resposta']);
	$chave = clear($_POST['chave']);
	$video = clear($_POST['video']);
	$produto = clear($_POST['produto']);
	$dataCadastro = clear($_POST['dataCadastro']);	
	$subCategoria = clear($_POST['subCategoria']);
	$usuario = clear($_POST['usuarioCadastro']);
	$idUsuario = clear($_POST['usuarioId']);
	
	if($resposta==''){
		$sql = "INSERT INTO pergunta (id_pergunta, pergunta, resposta, chave, produto, dataCadastro, video, subCategoria, usuario, idUsuario) VALUES (default, '$pergunta', null, '$chave', '$produto','$dataCadastro','$video','$subCategoria', '$usuario', '$idUsuario')";
	}else{
		$sql = "INSERT INTO pergunta (id_pergunta, pergunta, resposta, chave, produto, dataCadastro, video, subCategoria, usuario, idUsuario) VALUES (default, '$pergunta', '$resposta', '$chave', '$produto','$dataCadastro' ,'$video','$subCategoria', '$usuario', '$idUsuario')";
	}
	if(pg_query($conn, $sql)):
		$_SESSION['mensagem'] = "FAQ cadastrado com sucesso!";
		header('Location: ../perguntas.php');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar FAQ";
		header('Location: ../perguntas.php');
	endif;
endif;

if(isset($_POST['btn-cadastrarproduto'])):
	$nomeproduto = clear($_POST['nomeproduto']);
	$categoria = clear($_POST['categoria']);
	$customControlValidation1 = clear($_POST['visivel']);
		
		
				$sql = "INSERT INTO produto (id_produto, categoria, nomeproduto, visivel) VALUES (default, '$categoria', '$nomeproduto', 'true')";
				
	

	if(pg_query($conn, $sql)):
		$_SESSION['mensagem'] = "Produto cadastrado com sucesso!";
		header('Location: ../produtos.php');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar Produto";
		
	endif;
endif;