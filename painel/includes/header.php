<?php
include_once 'includes/ref.php';
if(!empty($_SESSION['id_usuario'])){
	//verifica se o login foi feito e permanece na pagina
}else{
	header("Location: index.php");	
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title> FAQ Appta Sistemas</title>
</head>

