<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro-Book Online Bookstore</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Carme" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
</head>

<!-- authentication -->
<?php include 'auth.php';
$name = $user['name'];
$email = $user['email'];
$address = $user['address'];
$phone = $user['phone'];

?>

<body id="profile">
<div class="header">
    <div class="logo">
        <img src="../img/logo.jpg" alt="Pro-Book">
    </div>
    <div class="username">
        <h2 class="current-user">Hi, <?php echo $username?></h2>
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
<!-- Profile page -->
<div class="profile-header">
    <div class="pencil-img">
        <a href="edit_profile.php"><img src="../img/115-Pencil.png"></a>
    </div>
    <div class="profile-header-header">
        <img id="profile-picture" src="../img/74-Sun.png" alt="profile-image">
    </div>
    <h1 id="name"><?php echo $name?></h1>
</div>
<div class="profile-body">
    <h2 id="profile-title">My Profile</h2>
    <div id="profile-detail" class="grid-2-container">
        <div class="grid-item-img">
            <img src="../img/131-Scarecrow.png">
        </div>
        <div class="grid-item">
            <p>Username</p>
        </div>
        <div class="grid-item">
            <p><?php echo $username; ?></p>
        </div>
        <div class="grid-item-img">
            <img src="../img/93-Card.png">
        </div>
        <div class="grid-item">
            <p>Email</p>
        </div>
        <div class="grid-item">
            <p><?php echo $email ?></p>
        </div>
        <div class="grid-item-img">
            <img src="../img/9-Map.png">
        </div>
        <div class="grid-item">
            <p>Address</p>
        </div>
        <div class="grid-item">
            <p><?php echo $address ?></p>
        </div>
        <div class="grid-item-img">
            <img src="../img/111-Bell.png">
        </div>
        <div class="grid-item">
            <p>Phone Number</p>
        </div>
        <div class="grid-item">
            <p><?php echo $phone ?></p>
        </div>
    </div>
</div>
</body>
</html>