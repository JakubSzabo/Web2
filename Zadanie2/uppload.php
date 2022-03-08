<?php
    
    require_once("config.php");

        try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connection successfully";
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }


    // $target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["csv"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   

    $csv = array();

    if(isset($_POST["submit"])) {
        // $tmpName = $_FILES['csv']['tmp_name'];
        // $csvAsArray = array_map('str_getcsv', file($tmpName));

        if($_FILES['csv']['error'] == 0){
            $name = $_FILES['csv']['name'];
            $ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
            $type = $_FILES['csv']['type'];
            $tmpName = $_FILES['csv']['tmp_name'];

            if($ext === 'csv'){
                if(($handle = fopen($tmpName, 'r')) !== FALSE){
                    set_time_limit(0);

                    $row = 0;

                    while(($data = fgetcsv($handle, 1000, ';')) !== FALSE){
                        $col_count = count($data);

                        $csv[$row]['en_pojem'] = $data[0];
                        $csv[$row]['en_skratka'] = $data[1];
                        $csv[$row]['sk_pojem'] = $data[0];
                        $csv[$row]['sk_skratka'] = $data[1];
                        
                        echo "<pre>";
                        var_dump($csv[$row]);
                        echo "</pre>";

                        $sql = 'SELECT id, name FROM term WHERE id=?';
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$csv[$row]['en_pojem']]);
                        //$statement = $conn->query($sql);
                        $terms = $stmt->fetchall(PDO::FETCH_ASSOC);

                        if(!(count($terms) > 0)){
                            $sql = "INSERT INTO term (name) VALUE (?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute([$csv[$row]['en_pojem']]); 
                        }

                        echo "<pre>";
                        var_dump($terms);
                        echo "</pre>";
                        echo "<br>-------------------------------------------------------<br> ";

                        $row++;
                    }
                    fclose($handle);
                }
            }
        }
    }

?>