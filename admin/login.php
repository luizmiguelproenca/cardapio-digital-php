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

if ($admin->loggedIn()) {
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
                    <h1 class="fs-4 card-title fw-bold mb-4">Admin</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                    </svg>
                    <!-- <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100"> -->
                </div>
                <div class="card shadow-lg">
                    <?php if ($loginMessage != '') { ?>
                        <div id="login-alert" class="alert alert-primary col-sm-12"><?php echo $loginMessage; ?></div>
                    <?php } ?>


                    <form id="loginform" class="needs-validation" role="form" method="POST" action="">
                        <div class="mb-0 p-4">
                            <input type="text" class="form-control" id="email" name="email" value="<?php if (!empty($_POST["email"])) {
                                                                                                        echo $_POST["email"];
                                                                                                    } ?>" placeholder="Email" style="background:white;" required>
                        </div>
                        <div class="mb-3 p-4">
                            <input type="password" class="form-control" id="password" name="password" value="<?php if (!empty($_POST["password"])) {
                                                                                                                    echo $_POST["password"];
                                                                                                                } ?>" placeholder="Senha" required>
                        </div>

                        <div class="form-group">
                            <div style="text-align: center; margin-bottom: 10px;">
                                <input type="submit" name="login" value="Login" class="btn btn-primary ms-auto">
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>