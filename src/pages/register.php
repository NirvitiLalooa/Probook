<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro-Book Online Bookstore</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Carme" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
    <link href="../css/login.css" type="text/css" rel="stylesheet">
    <script src="../js/register.js"></script>
    <link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">
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
$name = $username = $email = $password = $address = $phone = $bankAccount = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $bankAccount = $_POST["bankAccount"];

  $sql = "INSERT INTO Users (" . "name". "," . "username". "," . "email" . "," . "password" . "," . "address" . "," . "phone" . ",bankAccount" . ")
  VALUES ('".$name."', '".$username."', '".$email."', '".$password."', '".$address."', '".$phone."', '".$bankAccount."')";
  if ($conn->query($sql) === TRUE) {
    $sql2 = "SELECT * FROM Users WHERE username ="."'$username'";
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
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
      }
    } else {
      echo "User not found";
    }
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>

<body id="register">
    <div class="login-form-border">
        <div class="login-form-container">
            <h1>REGISTER</h1>
            <form class="register-form" id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <!-- Name  -->
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Name</div>
                <div class="col-sm-5"><input class="form-field" id="name-input" required type="text" name="name" value="" onkeyup="validateName()"/></div>
              </div>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10"><small style="visibility: hidden" id="name-err" class="err-message">Name maximum length = 20</small></div>
              </div>
              <!-- Username -->
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Username</div>
                <div class="col-sm-5"></span> <input class="form-field-short" required id="uname-input" type="text" name="username" value="" onkeyup="checkUsernameField()"/></div>
                <div class="col-sm-2"><img class="check-field" style="visibility: hidden" id="uname-check" src="../img/check.png" width="15px" height="15px"></div>
              </div>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10"><small style="visibility: hidden" class="err-message">Please input a valid username!</small></div>
              </div>
              <!-- Bank Account -->
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Bank Account</div>
                <div class="col-sm-5"><input class="form-field-short" required id="bankAccount-input" type="text" name="bankAccount" value="" onkeyup="checkBankAccountField()"/></div>
                <div class="col-sm-2"><img class="check-field" style="visibility: hidden" id="bankAccount-check" src="../img/check.png" width="15px" height="15px"></div>
              </div>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10"><small style="visibility: hidden" class="err-message">Please</small></div>
              </div>
              <!-- Email -->
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Email</div>
                <div class="col-sm-5"><input class="form-field-short" required id="email-input" type="text" name="email" value="" onkeyup="checkEmailField()"/></div>
                <div class="col-sm-2"><img class="check-field" id="email-check" style="visibility: hidden" src="../img/check.png" width="15px" height="15px"></div>
              </div>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10"><small style="visibility: hidden" id="email-err" class="err-message">Please input a valid email!</small></div>
              </div>
              <!-- Password -->
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Password</div>
                <div class="col-sm-5"><input class="form-field" id="password-input" required type="password" name="password" value=""/></div>
              </div>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10"><small style="visibility: hidden" class="err-message">Please </small></div>
              </div>
              <!-- Confirm Password -->
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Confirm Password</div>
                <div class="col-sm-5"><input class="form-field" id="confirmPassword-input"required type="password" name="confirm-password" value="" onkeyup="validatePassword()"/></div>
                <div class="col-sm-2"><small style="visibility: hidden" id="password-err" class="err-message">Password doesn't match</small></div>
              </div>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10"><small style="visibility: hidden" class="err-message"></small></div>
              </div>
              <!-- Address -->
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Address</div>
                <div class="col-sm-5"><input class="form-field" required type="textarea" name="address"/></div>
              </div>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10"><small style="visibility: hidden" class="err-message">Please </small></div>
              </div>
              <!-- Phone Number -->
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Phone Number</div>
                <div class="col-sm-5"><input class="form-field" required id="phone-input" type="text" name="phone" value="" onkeyup="validatePhoneNum()"/></div>
              </div>
              <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-10"><small style="visibility: hidden" id="phone-err" class="err-message">Please insert a valid phone number</small></div>
              </div>
              <!-- Form footer -->
              <div class="row"> 
                <div class="col-sm-1"></div>
                <div class="col-sm-11"><a href="login.php">Already have an account?</a></div>
              </div>
              <br/>
              <div class="row"> 
                <div class="col-sm-4"></div>
                <div class="col-sm-5"><input id="submit-register-btn" class="register-btn" type="submit" value="REGISTER"></div>
              </div>
            </form>
        </div>
    </div>
</body>
</html>