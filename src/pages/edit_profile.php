<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro-Book Online Bookstore</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Carme" rel="stylesheet">
    <link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
    <link href="../css/login.css" type="text/css" rel="stylesheet">
    <script src="../js/edit_profile.js"></script>
</head>


<!-- check logout  -->
<?php
if(isset($_GET['logout'])) {

unset($_COOKIE['token']);
setcookie('token', null, -1, '/');
header('Location: login.php');

exit;
}

if(isset($_GET['back'])) {
    header('Location: profile.php');
    exit;
}
?>

<!-- authentication -->
<?php include 'auth.php';
$userID = $user['userID'];
$name = $user['name'];
$email = $user['email'];
$address = $user['address'];
$phone = $user['phone'];
$pict = $user['pict'];
$bankAccount = $user['bankAccount'];
?>

<!-- Post update  -->
<?php
//input to variables using post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = make_better_input($_POST["name"]);
    $pict = make_better_input($_POST["pict"]);
    $address = make_better_input($_POST["address"]);
    $phone = make_better_input($_POST["phone"]);
    $bankAccount = make_better_input($_POST["bankAccount"]);

    //update database
    $sql = "UPDATE Users SET name = '".$name."', address = '".$address."', phone = '".$phone."', pict = '".$pict."' , bankAccount = '".$bankAccount."' WHERE userID = ".$userID;

    if ($conn->query($sql) === TRUE) {
        echo "
        ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// to make better data
function make_better_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<body id="profile">
    <div class="header">
        <div class="logo">
            <img src="../img/logo.jpg" alt="Pro-Book">
        </div>
        <div class="username">
            <h2 class="current-user">Hi, <?php echo $username ?></h2>
        </div>
        <div class="log-button">
            <a href="?logout"><img src="../img/log-button.jpg" alt="Logout" id="logout"></a>
        </div>
    </div>
    <nav class="menu-bar">
        <a href="search.php" class="browse">Browse</a>
        <a href="history.php" class="history">History</a>
        <a href="profile.php" class="profile">Profile</a>
    </nav>
    <!--edit profile here-->
    <div class="profile-body">
        <h1 id="profile-title">Edit Profile</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row"> 
                <div class="col-sm-4"></div>
                <div class="col-sm-8"><img src="../img/tayo.jpg"></div>
            </div>
            <div class="row"> 
                <div class="col-sm-3"></div>
                <div class="col-sm-2">Update profile picture</div>
                <div class="col-sm-7"><input type="text" value="<?php echo $pict ?>" name="pict"></div>
            </div>
            <div class="row"> 
                <div class="col-sm-3"></div>
                <div class="col-sm-2">Update bank account</div>
                <div class="col-sm-2"><input id="bankAccount-input" type="text" value="<?php echo $bankAccount ?>" name="bankAccount" onkeyup="validateBankAccount()"></div>
                <div class="col-sm-1"><img class="check-field" id="bankAccount-check" src="../img/check.png" width="15px" height="15px"></div>
            </div>
            <div class="row"> 
                <div class="col-sm-3"></div>
                <div class="col-sm-2">Name</div>
                <div class="col-sm-7"><input type="text" value="<?php echo $name?>" name="name"></div>
            </div>
            <div class="row"> 
                <div class="col-sm-3"></div>
                <div class="col-sm-2">Address</div>
                <div class="col-sm-7"><input type="text" value="<?php echo $address?>" name="address"></div>
            </div>
            <div class="row"> 
                <div class="col-sm-3"></div>
                <div class="col-sm-2">Phone Number</div>
                <div class="col-sm-7"><input type="text" value="<?php echo $phone?>" name="phone"></div>
            </div>
            <div class="row"> 
                <div class="col-sm-2"></div>
                <div class="col-sm-5"><a href="?back"><button class ="back-btn" type="button">Back</button></a></div>
                <div class="col-sm-5"><input id="submit-btn" class="save-btn" type="submit" value="Save"></div>
            </div>
            <div class="grid-container">
            </div>
        </form>
    </div>
</body>
</html>
