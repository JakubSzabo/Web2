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

  $sql = "INSERT INTO user (username, password, email, name, surname) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn ->prepare($sql);
  $result = $stmt->execute([$userName, $psw_hash, $email, $name, $surname]);

  header("Location: login.php")

?>

