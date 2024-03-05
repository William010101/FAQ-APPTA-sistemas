<?php
// Conexão
include_once 'php_action/db_connect.php';
include_once 'includes/ref.php';
if(!empty($_SESSION['id_usuario'])){
	//verifica se o login foi feito e permanece na pagina
}else{
	header("Location: ..\index.php");	
}

?>