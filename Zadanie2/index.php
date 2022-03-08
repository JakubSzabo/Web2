<?php include "header-footer/header.php" ?>

    <form action="uppload.php" method="post" enctype="multipart/form-data">
        <label for="csv">CSV File:</label>
        <input type="file" name="csv" id="csv">
        <input type="submit" name="submit" value="Uppload" id="submit">
    </form>

<?php include "header-footer/footer.php" ?>    