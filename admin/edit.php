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
        <h3>Editar produto</h3>
        <!-- <p class="text-muted">Complete the form</p> -->
    </div>
</div>


<?php
$item = $admin->buscarProduto($_GET['id']);
?>

<div class="container d-flex justify-content-center">
    <form action="" method="post" style="width: 50vw; min-width: 300px;">
        <div class="row">
            <div class="col">
                <label class="form-label" for="">Nome</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $item['name'] ?>" required>
                <label for="" class="form-label">Preço</label>
                <input type="number" name="preco" id="preco" class="form-control" value="<?php echo $item['price'] ?>" required>
            </div>

            <div class="col">
                <label class="form-label" for="">Categoria</label>
                <select type="text" name="categoria" class="form-control" id="categoria" required>
                    <option value="<?php echo $item['id_categoria'] ?>">Selecione</option>
                    <?php
                    $result = $categoria->categoriasList();
                    while ($item2 = $result->fetch_assoc()) { ?>
                        <option value="<?php echo $item2['id'] ?>"><?php echo $item2['nome'] ?></option>
                    <?php }; ?>
                </select>
                <label class="form-label" for="">Imagem</label>
                <input type="file" name="image" d="image" class="form-control" value="<?php echo $item['images'] ?>" />
            </div>

        </div>

        <div class="">
            <label class="form-label" for="">Descrição</label>
            <input type="text" class="form-control" name="desc" value="<?php echo $item['description'] ?>">
        </div>

        <div class="mb-3">

            <label class="form-label" for="">Categoria</label>
            <select type="text" name="status" class="form-control" id="categoria" required>
                <option value="<?php echo $item['status'] ?>">Selecione</option>
                <option value=1>Ativo</option>
                <option value=0>Inativo</option>
            </select>
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
    echo '<div class="container justify-content-center mt-5"><div class="alert alert-warning alert-dismissible fade show" role="alert">Produto já foi cadastrado!
    <button type="button" class="btn-close" data-bs-dismiss="alert"
    aria-lable="Close"></button></div></div>';
} else {
    if (isset($_POST['nome'])) {
        $admin->item_name = $_POST['nome'];
        $admin->item_idcategory = $_POST['categoria'];
        $admin->item_price = $_POST['preco'];
        $admin->item_description = $_POST['desc'];
        $admin->item_image = $_POST['image'];
        $admin->item_status = $_POST['status'];
        $admin->insertProduto();
        echo '<div class="container justify-content-center mt-5"><div class="alert alert-warning alert-dismissible fade show" role="alert">Produto cadastrado com sucesso!
        <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-lable="Close"></button></div></div>';
        $_SESSION['hash']  = $hash;
        header("Location: index.php?msg=Produto cadastrado com sucesso!");
    }
}
?>