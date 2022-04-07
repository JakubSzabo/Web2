<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
?>

<?php

include_once("config.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?> 

<?php
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];

if (str_contains($_SERVER['REQUEST_URI'], '?')) {
    $request = preg_split('/(\?|=)/', $_SERVER['REQUEST_URI']);
} else {
    $request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
}

$input = json_decode(file_get_contents('php://input'),true);   // php://input - read raw data from the request body

// connect to the mysql database
$link = mysqli_connect($servername,$username,$password,$dbname);
mysqli_set_charset($link,'utf8');
 
// retrieve the table and key from the path
$table = $request[1];
$key = $request[2];
if($method == 'GET'){ 
    if($key == 'all'){
        $sql = "SELECT * FROM $table";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $allInventors = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
        $allInventors = json_encode($allInventors);
            
        echo $allInventors;  
    }else if($table == 'edit'){
        $sql = "SELECT * FROM inventors WHERE id=$key";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $inventor = $stmt->fetchAll(PDO::FETCH_ASSOC); 
            
        $inventor = json_encode($inventor);
            
        echo $inventor;  
    }
}else if($method == 'DELETE'){
    $sql = "DELETE FROM $table WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$key]);
}
?> 