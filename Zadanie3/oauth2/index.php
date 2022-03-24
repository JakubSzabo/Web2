<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
?>

<?php

include_once("../config.php");

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../css/header-footer.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/error.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/logout.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <title>Zadanie 3</title>
</head>
<body>
    <header>
        <h1>Zadanie 3</h1>
    </header>
    <main id="main">
      <?php
      session_start();
      define('MYDIR','/home/xszaboj1/google-api-php-client--PHP8.0/');  //v2.12.1
      require_once(MYDIR."vendor/autoload.php");

      $redirect_uri = 'https://site165.webte.fei.stuba.sk/Zadanie3/oauth2/';

      $client = new Google_Client();
      $client->setAuthConfig('../../../configs/credentials.json');
      $client->setRedirectUri($redirect_uri);
      $client->addScope("email");
      $client->addScope("profile");
            
      $service = new Google_Service_Oauth2($client);
            
      if(isset($_GET['code'])){
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token);
        $_SESSION['upload_token'] = $token;

        // redirect back to the example
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
      }

      // set the access token as part of the client
      if (!empty($_SESSION['upload_token'])) {
        $client->setAccessToken($_SESSION['upload_token']);
        if ($client->isAccessTokenExpired()) {
          unset($_SESSION['upload_token']);
        }
      } else {
        $authUrl = $client->createAuthUrl();
      }

      if ($client->getAccessToken()) {
          //Get user profile data from google
          $UserProfile = $service->userinfo->get();
          if(!empty($UserProfile)){

            $sql = "SELECT * FROM google WHERE email=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$UserProfile['email']]);
            $newUser = $stmt->fetch(PDO::FETCH_ASSOC);

            if(empty($newUser)){
              $sql = "INSERT INTO google (email, name, last_name) VALUES (?, ?, ?)";
              $stmt = $conn ->prepare($sql);
              $result = $stmt->execute([$UserProfile['email'], $UserProfile['given_name'], $UserProfile['family_name']]);
            }

            $sql = "INSERT INTO loginlog_google (user_id, type, time_stamp) VALUES (?, ?, ?)";
            $stmt = $conn ->prepare($sql);
            $result = $stmt->execute([$newUser["id"], 'google', date("Y-m-d H:i:s")]);

            $_SESSION['id_user'] = $newUser["id"];

            echo '<div id="msg">';
            echo    '<h4>You have logged in successfully.</h4>';
            echo    '<h4>Hi '. $UserProfile['given_name'].' '.$UserProfile['family_name'].'</h4>';
            echo    "<a class='log' href='../info.php'>Login info</a><br>";
            echo    '<br><a class="log" href="logout.php">Logout</a>'; 
            echo '</div>';
          }   
        } else {
            $authUrl = $client->createAuthUrl();
            header("Location: ".filter_var($authUrl, FILTER_SANITIZE_URL));
        }
      ?> 
    </main>
    <footer>
        <h6>Jakub Szabo 2022&copy;</h6>

    </footer>
</body>
</html>