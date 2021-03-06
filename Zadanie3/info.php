<?php include 'header-footer/header.php' ?>

<?php

session_start();

$sql = 'SELECT * FROM user WHERE username=?';
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['username']]);
$userId = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = 'SELECT * FROM loginlog WHERE user_id=?';
$stmt = $conn->prepare($sql);
$stmt->execute([$userId['id']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$userID = $_SESSION['id_user'];

$sql = 'SELECT * FROM loginlog_google WHERE user_id=?';
$stmt = $conn->prepare($sql);
$stmt->execute([$userID]);
$usersGoogle = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
    <tr>
        <th>Type</th><th>Log Time</th>
    </tr>
    <?php
    if(!empty($userID)){
        foreach($usersGoogle as $user){
            echo "<tr>";
            echo "<td>$user[type]</td>";
            echo "<td>$user[time_stamp]</td>";
            echo "</tr>";
        }
    }else{
        foreach($users as $user){
            echo "<tr>";
            echo "<td>$user[type]</td>";
            echo "<td>$user[time_stamp]</td>";
            echo "</tr>";
        }
    }
    ?>
</table>

<?php 
    $sql = "SELECT * FROM loginlog WHERE type='register'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $register = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM loginlog_google WHERE type='google'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $google = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<br>
<table>
    <tr>
        <th>Register</th><th>Google</th>
    </tr>
    <tr>
        <td><?php echo sizeof($register) ?></td><td><?php echo sizeof($google) ?></td>
    </tr>
</table>

<?php include 'header-footer/footer.php' ?>