<?php 

session_start();

unset($_SESSION['upload_token']);

session_destroy();

header("Location: login.php")

?>