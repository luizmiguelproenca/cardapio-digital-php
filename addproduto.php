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
        <legend><b>Cadastrar Produto</b></legend>
        <br>
        <div class="inputBox">
            <input type="text" name="nome" id="nome" class="inputUser" required>
            <label for="nome" class="labelInput">Nome</label>
        </div>
        <br><br>
        <div class="inputBox">
            <input type="text" name="preco" id="preco" class="inputUser" required>
            <label for="email" class="labelInput">Preço</label>
        </div>
        <br><br>
        <div class="inputBox">
            <input type="text" name="desc" id="desc" class="inputUser" required>
            <label for="telefone" class="labelInput">Descrição</label>
        </div>
        <p>Categoria:</p>
        <select type="text" name="categoria" id="categoria" required>
            <option value="">Selecione</option>
            <?php
            $result = $categoria->categoriasList();
            while ($item = $result->fetch_assoc()) { ?>
                <option value="<?php echo $item['id'] ?>"><?php echo $item['nome'] ?></option>
            <?php }; ?>
        </select>
        <br><br>
        <input type="file" name="image" d="image" class="btn btn-success" multiple />
        <br><br>
        <input type="submit" name="submit" id="submit">
    </fieldset>
</form>


<?php

$hash = md5( implode( $_POST ) );

    if( isset( $_SESSION['hash'] ) && $_SESSION['hash'] == $hash ) {
        echo "Produto já foi cadastrado!";
    } else {
        if (isset($_POST['nome'])) {
            $admin->item_name = $_POST['nome'];
            $admin->item_idcategory = $_POST['categoria'];
            $admin->item_price = $_POST['preco'];
            $admin->item_description = $_POST['desc'];
            $admin->item_image = $_POST['image'];
            $admin->item_status = 1;
            $admin->insertProduto();
            echo "Produto adicionado com sucesso!";
            $_SESSION['hash']  = $hash;
        }
    }

?>