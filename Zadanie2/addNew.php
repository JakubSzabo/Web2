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

<?php 
    
if($_POST['en_pojem'] != null && $_POST['en_vysvetlenie'] != null && $_POST['sk_pojem'] != null && $_POST['sk_vysvetlenie'] != null){
    $sql = "INSERT INTO term (name) VALUES (?)";
    $stmt = $conn ->prepare($sql);
    $result = $stmt->execute([$_POST['en_pojem']]);

    $sql = 'SELECT id FROM term WHERE name=?';
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['en_pojem']]);
    $id = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "INSERT INTO glossary (term, description, language_id, term_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn ->prepare($sql);
    $result = $stmt->execute([$_POST['en_pojem'], $_POST['en_vysvetlenie'], 1, $id['id']]);

    $sql = "INSERT INTO glossary (term, description, language_id, term_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn ->prepare($sql);
    $result = $stmt->execute([$_POST['sk_pojem'], $_POST['sk_vysvetlenie'], 2, $id['id']]);
}

header('Location:' . "admin.php");

?>