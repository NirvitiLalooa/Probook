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
<?php include 'auth.php'?>;

<body id="result">
    <div class="header">
        <div class="logo">
            <img src="../img/logo.jpg" alt="Pro-Book">
        </div>
        <div class="username">
            <h2 class="current-user"><?php echo"Hi, $username" ?></h2>
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
        <?php
        include '../database/router.php';
        if(!isset($_COOKIE["id"])) {
            header('Location: login.php');
        } else {
            $userID = $_COOKIE["id"];
            $sql = "SELECT username FROM Users WHERE userID = $userID LIMIT 1";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $username = $row['username'];
        }
        
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT bookID, title, author, summary, thumbnail, cast(avg(rating) as decimal(10,1)) as avg_rating, count(buyerID) as c FROM books NATURAL JOIN orders WHERE (title LIKE '%$search%' OR author LIKE '%$search%') GROUP BY bookID";
        $result = $conn->query($sql) or die($conn->error);
        echo"<div class=\"title\">
            <h1 id=\"search-result\">Search Result</h1>
            <h2 id=\"search-found\">Found <u>".$result->num_rows."</u> result(s)</h2>
            </div>";
        while ( $book = $result->fetch_assoc()){
            echo "<div class=\"book-block\">
                <div id=\"pic\">";
                if($book["thumbnail"]!=NULL){
                    echo"<img src=\"../img/".$book["thumbnail"]."\"alt=\"This is picture\">";
                }else{
                    echo"<img src=\"../img/book-blank.png\"alt=\"This is picture\">";
                }
                echo"</div>
                <div id=\"content\">
                    <h2>".$book["title"]."</h2>
                    <h3>".$book["author"]." - ".$book["avg_rating"]."/5.0 (".$book["c"]." votes)</h3>
                    <p>".$book["summary"]."</p>
                </div>
            </div>";
            
            $hash = $book["bookID"];
            echo "<form action=\"detail.php\">
            <input type=\"hidden\" id=\"bookid\" name=\"bookid\" value=$hash>
            <input id=\"detail-btn\" type=\"submit\" value=\"Detail\">
            </form>
            <br>";
        }  
        ?>     
        
    </div>
</body>
</html>