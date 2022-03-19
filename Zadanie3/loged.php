<?php include 'header-footer/header.php' ?>

<?php 

session_start();
if(!(isset($_SESSION['username']) && !empty($_SESSION['username']))){
    header("Location: login.php");
}

?>

Vitaj <?php echo $_SESSION['username']; ?>
<a href="logout.php">Logout</a>

<?php include 'header-footer/footer.php' ?>