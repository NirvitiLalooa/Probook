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
<?php include 'auth.php'?>
<?php 
$userID = $user["userID"];
$sql = "SELECT * FROM Orders WHERE buyerID = $userID";
$result = $conn->query($sql);

$wsdl ="http://localhost:8888/ws/bookservice?wsdl";
$client = new SoapClient($wsdl, array('trace'=>1));
?>


<body id="history">
    <div class="header">
        <div class="logo">
            <img src="../img/logo.jpg" alt="Pro-Book">
        </div>
        <div class="username">
            <h2 class="current-user"><?php echo "Hi, ". $username ?></h2>
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
    <div class="container">
        <div class="title">
            <h1 id="search-book">History</h1>
        </div>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $bookid = $row['bookID'];
                $book = $client->detailBook($bookid);
                $book = json_decode($book, true);
                $book = $book[0];
                $book['author'] = $book['authors'][0];


                echo "<div class='book-card'>
                    <img id=\"pic\" src='".$book['imageUrl']."'>
                    <h2 id=\"mid\">".$book['title']."</h2>
                    <h3 id=\"right\">".$row['orderDate']."<br>
                    Nomor Order : ".$row['OrderID']."</h3>
                    <p id=\"mid\">Jumlah : ".$row['amount']." <br>";
                if ($row["review"] != ''){
                    echo "Anda sudah memberikan review</p>";
                } else { 
                    echo "Belum direview</p>
                    <button id='right' class='btn' onclick=\"window.location.href='review.php?order=".$row['OrderID']."'\">Review</button>";
                }
                echo "</div>";
            }
        } else {
            echo "User not found"; 
        }
        ?>
    </div>
</body>
</html>