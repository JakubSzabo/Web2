<?php
// ini_set("display_errors", 1);
// ini_set("display_startup_errors", 1);
// error_reporting(E_ALL);
?>

<?php

include_once("config.php");

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/error.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Zadanie 3</title>
</head>
<body>
    <header>
        <h1>Zadanie 3</h1>
    </header>
    <main id="main">