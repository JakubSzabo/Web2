<?php
    function td(){
            echo '<td></td>';
            echo '<td></td>';
        echo '</tr>';
    }

    function tr($file, $adressOfFilesFolder){
        if($file != ".."){
            echo '<tr>';
                echo '<td><a href="FileUpload.php?adressOfFilesFolder='.$adressOfFilesFolder.'/'.$file.'">'.$file.'</a></td>';
            td();
        }else{
            $arrayOfLinks = (explode("/",$adressOfFilesFolder));
            array_pop($arrayOfLinks);
            $arrayOfLinks = implode("/",$arrayOfLinks);

            echo '<tr>';
                echo '<td><a href="FileUpload.php?adressOfFilesFolder='.$arrayOfLinks.'">'.$file.'</a></td>';
            td();
        }
    }

    function echoTr($file, $fileSize, $correntDate){
        echo '<tr>';
            echo '<td>'.$file.'</td>';
            echo '<td>'.$fileSize.' Kb </td>';
            echo '<td>'.$correntDate.'</td>';
        echo '</tr>'; 
    }
?>

<table id="myTable">
    <tr>
        <th filterType="name" onclick="sort(this)">File Name <i class="fas fa-arrow-up"></i> <i class="fas fa-arrow-down"></i></th>
        <th filterType="size" onclick="sort(this)">File Size <i class="fas fa-arrow-up"></i> <i class="fas fa-arrow-down"></i></th>
        <th filterType="date" onclick="sort(this)">Upload Date <i class="fas fa-arrow-up"></i> <i class="fas fa-arrow-down"></i></th>
    </tr>
    <?php 

        $dir_handle = @opendir($adressOfFilesFolder) or die("Unable to open $adressOfFilesFolder");

        while($file = readdir($dir_handle)){

            $fileSize = round(filesize($adressOfFilesFolder.$file) / 1024, 2);

            $correntDate = date("d F Y H:i:s", filemtime($adressOfFilesFolder.$file));
            
            if($_GET['adressOfFilesFolder'] == null || $_GET['adressOfFilesFolder'] == '/home/xszaboj1/files/'){
                if(strpos($file,".") != null && $file != '.' &&   $file != '..'){
                    echoTr($file, $fileSize, $correntDate);
                }else{
                    if($file != '.' && $file != '..'){
                        tr($file, $adressOfFilesFolder);
                    }
                }
            }else{
                if(strpos($file,".") != null && $file != '.' &&   $file != '..'){
                    echoTr($file, $fileSize, $correntDate);
                }else if($file != '.'){
                    tr($file, $adressOfFilesFolder); 
                }
            }
        }

        closedir($dir_handle);
    ?>  
</table>