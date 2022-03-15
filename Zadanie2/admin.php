<?php include "header-footer/header.php" ?>

    <?php 
    
    $sql = 'SELECT id, name FROM term';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <?php include "table.php" ?>

    <form action="upload.php" method="post" enctype="multipart/form-data" id="adminForm">
        <label for="csv">CSV File:</label>
        <input type="file" name="csv" id="csv">
        <input onclick="formCheck(event)" type="submit" name="submit" value="Upload CSV" id="submit">
    </form>

    <form action="addNew.php" method="post" enctype="multipart/form-data" id="addNew">
        <div>
            <label for="en_pojem">English term:</label> 
            <input type="text" name="en_pojem" required> 
        </div>
        <div>
            <label for="en_vysvetlenie">English description:</label>  
            <input type="text" name="en_vysvetlenie" required> 
        </div>
        <div>
            <label for="sk_pojem">Slovak term:</label>  
            <input type="text" name="sk_pojem" required> 
        </div>
        <div>
            <label for="sk_vysvetlenie">Slovak description:</label>  
            <input type="text" name="sk_vysvetlenie" required> 
        </div>
        
        <input id="addSubmit" type="submit" name="addSubmit" value="Add">
    </form>
            
<?php include "header-footer/footer.php" ?>   