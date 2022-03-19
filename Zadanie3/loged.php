<?php include 'header-footer/header.php' ?>

<?php 

session_start();
if(!(isset($_SESSION['username']) && !empty($_SESSION['username']))){
    header("Location: login.php");
}

?>
<div id="msg">
    <h4>You have logged in successfully.</h4> 
    <h4>Hi <?php echo $_SESSION['username']; ?></h4>
    
    <a class='log' href='info.php'>Login info</a><br>

    <br><a class="log" href="logout.php">Logout</a>
</div>

<?php include 'header-footer/footer.php' ?>