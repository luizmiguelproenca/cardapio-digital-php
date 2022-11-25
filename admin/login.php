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

if($admin->loggedIn()) {	
	header("Location: index.php");	
}

include('../inc/header.php');

$loginMessage = '';
if (!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $admin->email = $_POST["email"];
    $admin->password = $_POST["password"];
    if ($admin->login()) {
        header("Location: index.php");
    } else {
        $loginMessage = 'Dados incorretos!';
    }
} else {
    $loginMessage = 'Preencha todos os campos';
}

?>


<title>Painel Admin</title>
<?php include('../inc/container.php'); ?>
<div class="h-100">
    <div class="container h-100">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="text-center my-5">
                    <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                    <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
                </div>
                <div class="card shadow-lg">
                    <?php if ($loginMessage != '') { ?>
                        <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>
                    <?php } ?>


                    <form id="loginform" class="needs-validation" role="form" method="POST" action="">
                        <div style="margin-bottom: 25px" class="mb-3 p-4">
                            <span class="mb-2 text-muted"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" id="email" name="email" value="<?php if (!empty($_POST["email"])) {
                                                                                                        echo $_POST["email"];
                                                                                                    } ?>" placeholder="email" style="background:white;" required>
                        </div>
                        <div class="mb-3 p-4">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" value="<?php if (!empty($_POST["password"])) {
                                                                                                                    echo $_POST["password"];
                                                                                                                } ?>" placeholder="senha" required>
                        </div>

                        <div class="form-group">
                            <div class="ms-0">
                                <input type="submit" name="login" value="Login" class="btn btn-primary ms-auto">
                            </div>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>