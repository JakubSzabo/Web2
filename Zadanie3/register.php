<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
?>

<?php

include_once("config.php");

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?> 

<?php 

  $userName = $_POST["userName"];
  $email = $_POST["email"];
  $psw_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $name = $_POST["name"];
  $surname = $_POST["surname"];

  $sql = 'SELECT username FROM user WHERE username=?';
  $stmt = $conn->prepare($sql);
  $stmt->execute([$userName]);
  $userChack = $stmt->fetch(PDO::FETCH_ASSOC);

  if($userChack == null){

    include 'header-footer/header.php';

    require_once 'PHPGangsta/GoogleAuthenticator.php';
    
    $websiteTitle = 'MyWebsite';
    
    $ga = new PHPGangsta_GoogleAuthenticator();
    
    $secret = $ga->createSecret();
    echo 'Secret is: '.$secret.'<br />';
    
    $qrCodeUrl = $ga->getQRCodeGoogleUrl($websiteTitle, $secret);
    echo 'Google Charts URL QR-Code:<br /><img src="'.$qrCodeUrl.'" />';

    ?>

    <a href="login.php">Login</a>
    
    <?php
    include 'header-footer/footer.php';


    $sql = "INSERT INTO user (username, password, email, name, surname, app) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn ->prepare($sql);
    $result = $stmt->execute([$userName, $psw_hash, $email, $name, $surname, $secret]);
  }else{
    header("Location: index.php?user=1");
  }
?>

