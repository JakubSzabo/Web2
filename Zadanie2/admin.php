<?php include "header-footer/header.php" ?>

    

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="csv">CSV File:</label>
        <input type="file" name="csv" id="csv">
        <input onclick="formCheck(event)" type="submit" name="submit" value="Upload CSV" id="submit">
    </form>

<?php include "header-footer/footer.php" ?>   