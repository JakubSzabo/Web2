<?php include "header-footer/header.php" ?>
<a id="back" href="index.php"> Back </a>
<?php

if($_POST['searchValue'] != null){

    if($_POST['otherLanguage'] == 'otherLanguage' && $_POST['fullText'] == ""){
        $search = $_POST['searchValue'] . "%";
    
        $sql = 'SELECT * FROM glossary WHERE term LIKE ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$search]);
        $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'searchTableLanguage.php';

    }

    else if($_POST['fullText'] == 'fullText'){
        $search = "%" . $_POST['searchValue'] . "%";

        $sql = 'SELECT * FROM glossary WHERE term OR description LIKE ?';
        $stmt = $conn->prepare($sql);
        $stmt->execute([$search]);
        $terms = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'searchTableLanguage.php';
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