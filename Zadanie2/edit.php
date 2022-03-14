<?php include "header-footer/header.php" ?>

    <?php 
        if(isset($_POST['edit']) && isset($_GET['id']) && !empty($_GET['id'])){
            $sql = "UPDATE term SET name = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['en_pojem'], $_GET['id']]);

            $sql = "UPDATE glossary SET term = ?, description = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['en_pojem'], $_POST['en_vysvetlenie'], $_POST['termENid']]);
        
            $sql = "UPDATE glossary SET term = ?, description = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$_POST['sk_pojem'], $_POST['sk_vysvetlenie'], $_POST['termSKid']]);
        }

        if(isset($_POST['delete']) && isset($_GET['id']) && !empty($_GET['id'])){
            $sql = "DELETE FROM term WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([htmlspecialchars($_GET['id'])]);

            header('Location:' . "admin.php");
        }

        if(isset($_GET['id']) && !empty($_GET['id'])){
            $sql = "SELECT * FROM glossary WHERE language_id = 1 and term_id = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->execute([htmlspecialchars($_GET['id'])]);
            $termEN = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $sql = "SELECT * FROM glossary WHERE language_id = 2 and term_id = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->execute([htmlspecialchars($_GET['id'])]);
            $termSK = $stmt->fetch(PDO::FETCH_ASSOC);
        }

    ?>

    <h2>Edit</h2>
    <a href="admin.php" id="back">Back</a>
    <form 
        id="editForm" 
        <?php echo "action='edit.php?id=" . htmlspecialchars($_GET['id']) . "'" ?>
        method="POST">

        <input type="hidden" id="termENid" name="termENid" value="<?php echo $termEN['id']; ?>">
        <input type="hidden" id="termSKid" name="termSKid" value="<?php echo $termSK['id']; ?>">

        <div>
            <label for="en_pojem">En pojem:</label>
            <input 
                type="text" 
                name="en_pojem" 
                id="en_pojem" 
                value="<?php echo $termEN['term']; ?>">
        </div>
        <div>
            <label for="en_vysvetlenie">En vysvetlenie:</label>
            <textarea 
                name="en_vysvetlenie" 
                id="en_vysvetlenie" 
                rows="3"
            ><?php echo $termEN['description']; ?>
            </textarea>
        </div>
        <div>
            <label for="sk_pojem">Sk pojem:</label>
            <input 
                type="text" 
                name="sk_pojem" 
                id="sk_pojem" 
                value="<?php echo $termSK['term']; ?>">
        </div>
        <div>
            <label for="sk_vysvetlenie">Sk vysvetlenie:</label>
            <textarea 
                name="sk_vysvetlenie" 
                id="sk_vysvetlenie" 
                rows="3"
            ><?php echo $termSK['description']; ?>
            </textarea>
        </div>
        
        <input type="submit" id="submit" name="edit" value="Edit">

        <input type="button" id="deleteBtn" onclick="confirm()" value="Delete">
        <div id="backGround">
            <div id="confirm">
                <h3>Are you sure you want to delete this one?</h3>
                <input type="button" id="closeDelete" value="No" onclick="confirmClose()">
                <input type="submit" id="delete" name="delete" value="Yes delete it">
            </div>
        </div>
        
    </form>
<?php include "header-footer/footer.php" ?>   