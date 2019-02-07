<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro-Book Online Bookstore</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Carme" rel="stylesheet">
    <link href="../css/login.css" type="text/css" rel="stylesheet">
</head>

<!-- connect to database -->
<?php 
  include '../database/connect.php'; 
  if(isset($_COOKIE["token"])) {
    header('Location: search.php'); 
  } 
?>

<?php
// define variables and set to empty values
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM Users WHERE username='$username' ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if($password == $row["password"]){
        // Generate access token
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randToken = '';
        for ($i = 0; $i < 20; $i++) {
            $randToken .= $characters[rand(0, $charactersLength - 1)];
        }
        $expireTime = date("Y-m-d H:i:s", time() + 43200);
        $userID = $row["userID"];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $sql_insertion = "INSERT INTO AccessToken (token, expire, userID, browser, ipAddress)
        VALUES ('$randToken', '$expireTime', '$userID', '$browser', '$ipAddress');";

        if ($conn->query($sql_insertion) === TRUE) {
            echo "New token created successfully";
        } else {
            echo $sql_insertion;
            echo "<br>";
            echo $conn->error;
        }

        // set cookie
        $cookie_name = "token";
        $cookie_value = $randToken;
        setcookie($cookie_name, $cookie_value, time() + (43200), "/");
        header('Location: search.php'); 
      } else {
        echo "Username and password mismatched.";
      }
    }
  } else {
      echo "User not found"; 
  }

  $conn->close();
}
?>

<body id="login">
    <div class="login-form-border">
        <div class="login-form-container">
            <h1>LOGIN</h1>
            <form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Username &emsp; <input type="text" name="username" value=""><br><br>
                Password &emsp; <input type="password" name="password" value=""><br><br>
                <a href="register.php">Don't have an account?</a><br><br>
                <input class="login-btn" type="submit" value="LOGIN">
            </form>
        </div>
    </div>
</body>
</html>