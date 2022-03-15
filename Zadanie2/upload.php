<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
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

<?php

if(isset($_POST["submit"])) {
    $csv = array();
    if ($_FILES['csv']['error'] == 0){
        $name = $_FILES['csv']['name'];
        $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
        $type = $_FILES['csv']['type'];
        $tmpName = $_FILES['csv']['tmp_name'];

        if($ext === 'csv'){
            if(($handle = fopen($tmpName, 'r')) !== FALSE) {
                set_time_limit(0);

                $row = 0;

                while(($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
                    $col_count = count($data);

                    $csv[$row]['en_pojem'] = $data[0];
                    $csv[$row]['en_vysvetlenie'] = $data[1];
                    $csv[$row]['sk_pojem'] = $data[2];
                    $csv[$row]['sk_vysvetlenie'] = $data[3];
                    
                    $sql = 'SELECT id, name FROM term WHERE name=?';
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$data[0]]);
                    $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // echo '<pre>';
                    // var_dump($terms);
                    // echo '</pre>';

                    if(!(count($terms) > 0)){
                        $sql = "INSERT INTO term (name) VALUES (?)";
                        $stmt = $conn ->prepare($sql);
                        $result = $stmt->execute([$csv[$row]['en_pojem']]);

                        // echo '<pre>';
                        // var_dump($result);
                        // echo '</pre>';

                        $sql = 'SELECT id FROM term WHERE name=?';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$data[0]]);
                        $id = $stmt->fetch(PDO::FETCH_ASSOC);

                        // echo '<pre>';
                        // var_dump($id['id']);
                        // echo '</pre>';

                        $sql = "INSERT INTO glossary (term, description, language_id, term_id) VALUES (?, ?, ?, ?)";
                        $stmt = $conn ->prepare($sql);
                        $result = $stmt->execute([$csv[$row]['en_pojem'], $csv[$row]['en_vysvetlenie'], 1, $id['id']]);

                        $sql = "INSERT INTO glossary (term, description, language_id, term_id) VALUES (?, ?, ?, ?)";
                        $stmt = $conn ->prepare($sql);
                        $result = $stmt->execute([$csv[$row]['sk_pojem'], $csv[$row]['sk_vysvetlenie'], 2, $id['id']]);
                    }

                    $row++;

                    echo '<hr>';
                }
                fclose($handle);
            }
        }
    }
}
header('Location:' . "admin.php");
?>