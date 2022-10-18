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

// include('inc/header.php'); -- bootstrap
?>

<form method="post" action="">
    <fieldset>
        <legend><b>Cadastrar Categoria</b></legend>
        <br>
        <div class="inputBox">
            <input type="text" name="nome" id="nome" class="inputUser" required>
            <label for="nome" class="labelInput">Nome</label>
        </div>
        <br><br>
        <input type="file" name="image" d="image" class="btn btn-success" multiple />
        <br><br>
        <input type="submit" name="submit" id="submit">
    </fieldset>
</form>


<?php

$hash = md5( implode( $_POST ) );

    if( isset( $_SESSION['hash'] ) && $_SESSION['hash'] == $hash ) {
        echo "Categoria já foi cadastrada!";
    } else {
        if (isset($_POST['nome'])) {
            $admin->item_catName = $_POST['nome'];
            $admin->item_catImage = $_POST['image'];
            $admin->item_catStatus = 1;
            $admin->insertCategoria();
            echo "Categoria adicionada com sucesso!";
            $_SESSION['hash']  = $hash;
        }
    }
    
?>