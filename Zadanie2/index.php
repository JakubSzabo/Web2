<?php include "header-footer/header.php" ?>

    <?php
    
        include_once("config.php");

         try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connection successfully";
        } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    ?>

    <form action="uppload.php" method="post" enctype="multipart/form-data">
        <label for="csv">CSV File:</label>
        <input type="file" name="csv" id="csv">
        <input type="submit" name="submit" value="Uppload" id="submit">
    </form>

<?php include "header-footer/footer.php" ?>    