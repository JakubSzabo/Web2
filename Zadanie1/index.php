<?php include 'header-footer/header.php'; ?>
        
        <form action="FileUpload.php" method="post" enctype="multipart/form-data">
            <label for="fileName">Filename:</label>
            <input type="text" name="fileName" id="fileName">
            <input type="file" name="file" id="file">
            <br>
            <input  onclick="formCheck(event)" type="submit" name="submit" value="Submit" id="submit">
        </form>

<?php include 'header-footer/footer.php' ?>
