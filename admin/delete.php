<?php
include_once '../config/Database.php';
include_once '../class/Produto.php';
include_once '../class/Categoria.php';
include_once '../class/Admin.php';

$database = new Database();
$db = $database->getConexao();


$categoria = new Categoria($db);
$produto = new Produto($db);
$admin = new Admin($db);

$id = $_GET['id'];

$deletado = $admin->deleteProduto($id);

if($deletado){
    header("Location: index.php?msg=Produto deletado com sucesso!");
}
else{
    echo "Falha! ". mysqli_error($deletado);
}

?>