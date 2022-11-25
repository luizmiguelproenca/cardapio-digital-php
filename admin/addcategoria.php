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

if (!$admin->loggedIn()) {
    header("Location: login.php");
}

include('../inc/header.php');
?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Cadastrar Categoria</h3>
        <!-- <p class="text-muted">Complete the form</p> -->
    </div>
</div>

<div class="container d-flex justify-content-center">
    <form action="" method="post" style="width: 50vw; min-width: 300px;">
        <div class="row">

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="submit">
                    Cadastrar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
    </form>
</div>


<?php
$hash = md5(implode($_POST));

if (isset($_SESSION['hash']) && $_SESSION['hash'] == $hash) {
    echo "Categoria já foi cadastrada!";
} else {
    if (isset($_POST['nome'])) {
        $admin->item_catName = $_POST['nome'];
        $admin->item_catStatus = 1;
        $admin->insertCategoria();
        echo "Categoria adicionada com sucesso!";
        $_SESSION['hash']  = $hash;
    }
}
?>