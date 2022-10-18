<?php
include_once 'config/Database.php';
include_once 'class/Produto.php';
include_once 'class/Categoria.php';
include_once 'class/Admin.php';

$database = new Database();
$db = $database->getConexao();
$categoria = new Categoria($db);
$produto = new Produto($db);
$admin = new Admin($db);

if(!$admin->loggedIn()) {	
	header("Location: login.php");	
}
?>

<h1>LOGADO</h1>
<h2>Aqui irei fazer a pagina do ADM do cardápio</h2>

<a href="desloga.php">SAIA</a>