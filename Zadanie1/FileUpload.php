<?php include 'header-footer/header.php' ?>

    <?php 
        date_default_timezone_set("Europe/Bratislava");
        $fileName = $_FILES['file']['name'];
        $fileType = substr($fileName, strrpos($fileName, ".") + 1);
        $tmpName = $_FILES['file']['tmp_name'];
        $newFileName = $_POST['fileName'];
        $correntTime = date("-h-i-s");
        
        if($_GET['adressOfFilesFolder'] == null){
            $adressOfFilesFolder = "/home/xszaboj1/files/";
        }else{
            $adressOfFilesFolder = $_GET['adressOfFilesFolder'];
        }
    ?>

    <div class="backArrow">
        <a href="index.php" id="back">Back</a>
    </div>

    <?php 

        if($_FILES["file"]["error"] > 0){
            echo "Error".$_FILES["file"]["error"]."<br>";
        }else{
            if(file_exists($adressOfFilesFolder.$newFileName.".".$fileType)){
                move_uploaded_file($tmpName, $adressOfFilesFolder.$newFileName.$correntTime.".".$fileType); 
            }else{
                move_uploaded_file($tmpName, $adressOfFilesFolder.$newFileName.".".$fileType); 
            }
        }
        
    ?>

    <div>
        <?php include 'table.php' ?>
    </div>

<?php include 'header-footer/footer.php' ?>