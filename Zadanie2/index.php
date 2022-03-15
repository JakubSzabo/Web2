<?php include "header-footer/header.php" ?>

    <form action="search.php" method="post" enctype="multipart/form-data" id="search">
        <div>
            <label for="search">Search:</label>
            <input type="text" name="searchValue" id="searchValue" minlength="3" required>
        </div>
        <div>
            <label for="otherLanguage">Search on other language:</label>
            <input 
                type="checkbox" 
                id="otherLanguage" 
                name="otherLanguage" 
                value="otherLanguage"
            >
        </div>
        <div>
            <label for="fullText">Full text search:</label>
            <input 
                type="checkbox" 
                id="fullText" 
                name="fullText" 
                value="fullText"
            >
        </div>
        <input type="submit" name="submit" value="Search" id="searchSubmit">
    </form>

<?php include "header-footer/footer.php" ?>    