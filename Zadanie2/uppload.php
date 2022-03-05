<?php
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

                        $sql = 'SELECT id, name FROM term';
                        $statement = $conn->query($sql);
                        $terms = $statement->fetchAll(PDO::FETCH_ASSOC);

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