<!-- check logout  -->
<?php
if(isset($_GET['logout'])) {
// Delete access token

unset($_COOKIE['token']);
setcookie('token', null, -1, '/');
header('Location: login.php');
exit;
}


include '../database/connect.php';
if(!isset($_COOKIE["token"])) {
    header('Location: login.php');
} else { 
    // check access token validity
    $accessToken = $_COOKIE["token"];
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ipAddress = $_SERVER['REMOTE_ADDR'];
    $currentTime = date("Y-m-d H:i:s", time());
    $sql_token = "SELECT * FROM AccessToken WHERE token = '$accessToken' AND ipAddress = '$ipAddress' AND expire > '$currentTime' AND browser = '$browser' LIMIT 1;";
    $result = $conn->query($sql_token);
    if(mysqli_num_rows($result) == 0){
        unset($_COOKIE['token']);
        setcookie('token', null, -1, '/');
        header('Location: login.php');
    }
    $token = $result->fetch_assoc();
    
    $userID = $token['userID']; // user ID
    $sql_user = "SELECT * FROM Users WHERE userID = '$userID' LIMIT 1";
    $result_user = $conn->query($sql_user);
    if(!$result_user)
        echo "User not found";
    $user = $result_user->fetch_assoc();
    $username = $user['username'];
}
?>