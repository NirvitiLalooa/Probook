<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro-Book Online Bookstore</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Carme" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
    <script src="../js/book.js"></script>
</head>

<!-- authentication -->
<?php include 'auth.php'?>;

<!-- get book and order data -->
<?php
$orderID = $_REQUEST["order"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review = $_POST["review"];
    $rating = $_POST["rating"];
  
    $sql = "UPDATE Orders SET review='".$review."', rating='".$rating."' WHERE orderID = $orderID";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: history.php'); 
    } else {
        echo "Error updating record: " . $conn->error;
    }    
}


$sql = "SELECT * FROM Orders WHERE orderID = $orderID";
$result = $conn->query($sql);
$order = $result->fetch_assoc();
$conn->close();
?>
<?php 
    //WSDL location
    $wsdl ="http://localhost:8888/ws/bookservice?wsdl";
    //create soap client
    $client = new SoapClient($wsdl, array('trace'=>1));
    $bookid = $order['bookID'];
    $book = $client->detailBook($bookid);
    $book = json_decode($book, true);
    $book = $book[0];
    $book['author'] = $book['authors'][0];
?>

<body id="review">
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
            <img src=<?php echo $book['imageUrl'];?> height='200' width='200'>
            <h1 id="search-book"><?php echo $book['title'];?></h1>
            <p><?php echo $book['author'];?></p>
        </div>     
        <form id="review-form" method="post" action="review.php?order=<?php echo $orderID;?>">
            <div class="rating-form">
                <h2>Add Rating</h2>
                <input type="radio" name="rating" value="1"> 1
                <input type="radio" name="rating" value="2"> 2
                <input type="radio" name="rating" value="3"> 3
                <input type="radio" name="rating" value="4"> 4
                <input type="radio" name="rating" value="5"> 5
            </div>
            <div class="comment">
                <h2>Add Comment</h2>
                <textarea name="review" rows="5" cols="50" value="<?php echo $order["review"];?>"></textarea>
            </div>
            <a href="history.php"><button class ="back-btn" type="button">Back</button></a>
            <input class="review-btn" type="submit" value="Submit">
        </form>
    </div>
</body>
</html>