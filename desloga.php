<?php 
session_start();
$_SESSION["userid"] = '';
$_SESSION["name"] = '';
session_destroy();
header("Location:login.php");
?>