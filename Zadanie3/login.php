<?php include 'header-footer/header.php' ?>

<?php 

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "SELECT * FROM user Where username=?";

    $stm = $conn->prepare($sql);
    $stm->execute([htmlspecialchars($_POST["userName"])]);

    $user = $stm->fetch(PDO::FETCH_ASSOC);

    if($user){
        if(password_verify($_POST['password'], $user['password'])){
            $_SESSION['username'] = $user['username'];

            $sql = "INSERT INTO loginlog (user_id, type, time_stamp) VALUES (?, ?, ?)";
            $stmt = $conn ->prepare($sql);
            $result = $stmt->execute([$user['id'], 'register', date("Y-m-d H:i:s")]);

            header("Location: loged.php");
        }
    }
}

?>

<form action="login.php" method="post" enctype="multipart/form-data">        
    <label for="userName">User name:</label><br>
    <input type="text" name="userName" required><br>
        
    <label for="name">Password:</label><br>
    <input type="password" name="password" id="password" required><br>
    
    <input type="submit" value="Login" id="submit">
    <br><a href="index.php">Sign Up</a>
</form>

<?php include 'header-footer/footer.php' ?>