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

if($admin->loggedIn()) {	
	header("Location: testLogin.php");	
}

include('inc/header.php');

$loginMessage = '';
if (!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $admin->email = $_POST["email"];
    $admin->password = $_POST["password"];
    if ($admin->login()) {
        header("Location: testLogin.php");
    } else {
        $loginMessage = 'Login errado!';
    }
} else {
    $loginMessage = 'Preencha todos os campos';
}

?>

<title>webdamn.com : Demo Online Food Ordering System with PHP & MySQL</title>
<?php include('inc/container.php'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading" style="background:#5bc0de;color:white;">
                    <div class="panel-title">Customer Log In</div>
                </div>
                <div style="padding-top:30px" class="panel-body">
                    <?php if ($loginMessage != '') { ?>
                        <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $loginMessage; ?></div>
                    <?php } ?>


                    <form id="loginform" class="form-horizontal" role="form" method="POST" action="">
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" id="email" name="email" value="<?php if (!empty($_POST["email"])) {
                                                                                                        echo $_POST["email"];
                                                                                                    } ?>" placeholder="email" style="background:white;" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" value="<?php if (!empty($_POST["password"])) {
                                                                                                                    echo $_POST["password"];
                                                                                                                } ?>" placeholder="password" required>
                        </div>

                        <div style="margin-top:10px" class="form-group">
                            <div class="col-sm-12 controls">
                                <input type="submit" name="login" value="Login" class="btn btn-info">
                            </div>
                        </div>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>