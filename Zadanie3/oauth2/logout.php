<?php
session_start();
define('MYDIR','/home/xszaboj1/google-api-php-client--PHP8.0/');
require_once(MYDIR."vendor/autoload.php");

$client = new Google_Client();
$client->setAuthConfig('../../../configs/credentials.json');
      
//Unset token from session
unset($_SESSION['upload_token']);
unset($_SESSION['id_user']);

// Reset OAuth access token
$client->revokeToken();

//Destroy entire session
session_destroy();

//Redirect to homepage      
header("Location: ../login.php");
?>