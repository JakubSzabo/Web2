<?php include "header-footer/header.php" ?>

<?php

if($_POST['searchValue'] != null){
    // echo $_POST['searchValue'];
    // echo $_POST['otherLanguage'];
    // echo $_POST['fullText'];

    if($_POST['otherLanguage'] == 'otherLanguage' && $_POST['fullText'] == ""){
        $search = $_POST['searchValue'] . "%";
    
        $sql = 'SELECT * FROM glossary WHERE term LIKE ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$search]);
        $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'searchTableLanguage.php';

        echo "<pre>";
        var_dump($terms);
        echo "</pre>";

    }

    else if($_POST['fullText'] == 'fullText'){
        $search = "%" . $_POST['searchValue'] . "%";

        $sql = 'SELECT * FROM glossary WHERE term OR description LIKE ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$search]);
        $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<pre>";
        var_dump($terms);
        echo "</pre>";
    }

    else{
        $search = $_POST['searchValue'] . "%";
    
        $sql = 'SELECT term, description FROM glossary WHERE term LIKE ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$search]);
        $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'searchTable.php';
        
    }

    
}

?>

<?php include "header-footer/footer.php" ?>   