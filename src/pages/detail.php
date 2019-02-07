<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro-Book Online Bookstore</title>
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Carme" rel="stylesheet">
    <link href="../css/style.css" type="text/css" rel="stylesheet">
    <link href="../css/modal.css" type="text/css" rel="stylesheet">
    <script src="../js/order.js"></script> 
</head>

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

<?php
	//WSDL location
	$wsdl ="http://localhost:8888/ws/bookservice?wsdl";
	//create soap client
	$client = new SoapClient($wsdl, array('trace'=>1));
    
    $bookid = $_GET["bookid"];
	//specific service call
	try
	{
        $book = $client->detailBook($bookid);
        $book = json_decode($book, true);
        $book = $book[0];
        $book['author'] = $book['authors'][0];
	} 
	catch (Exception $e) 
	{ 
		echo "<h2>Exception Error!</h2>"; 
		echo $e->getMessage(); 
    }
    
    try
	{
        $recommendation = $client->recommendBook($book['categories']);
        $recommendation = json_decode($recommendation, true);
        if (sizeof($recommendation) > 0)
            $recommendation = $recommendation[0];
	} 
	catch (Exception $e) 
	{ 
		echo "<h2>Exception Error!</h2>"; 
		echo $e->getMessage(); 
	}
?>

<body id="detail">
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
        <div id="notif" onclick=off()>
            <div id="box">Pemesanan Berhasil!</div>
        </div>

        <div class="content-section">
            <h1 class="title"> <?php echo $book['title']?></h1>
            <h2 class="author"> <?php echo $book['author']?></h2>
            <div id="content-detail">
                <p><?php echo $book['description']?></p>
            </div>
            <div id="content-img">
                <?php echo "<img src=".$book['imageUrl']."/>"?>
            </div>
        </div>

        <?php 
            if ($book['price'] == -1){
                echo "
                <div class='order-section'>
                    <h2 id='order'>NOT FOR SALE</h2>
                </div>
                ";
            } else {
                echo "<div class='order-section'>
                <h2 id='order'>Order</h2>
                <form id='form-order' action='' method='POST'>
                    <p>
                        <label>Jumlah</label>
                        <select id = 'amount' name='amount'>
                            <option value = '1'>1</option>
                            <option value = '2'>2</option>
                            <option value = '3'>3</option>
                            <option value = '4'>4</option>
                            <option value = '5'>5</option>
                            <option value = '6'>6</option>
                            <option value = '7'>7</option>
                            <option value = '8'>8</option>
                            <option value = '9'>9</option>
                            <option value = '10'>10</option>
                            <option value = '11'>11</option>
                            <option value = '12'>12</option>
                        </select>
                    </p>
                    <input id='book-id' type='hidden' value='".$_GET['bookid']."'>
                    <input id='user-id' type='hidden' value='".$bankAccount."'>
                    <input id='beneran-id' type='hidden' value='".$userID."'>
                </form>
                    <button id='order-btn' onclick='order()'>Order</button>
            </div>";
            }
        ?>

        
        <div class="review-section">
            <h2 id="review">Reviews</h2>
            <?php
                $sql = "SELECT bookID, username, rating, review, pict FROM orders JOIN users ON buyerID = userID WHERE bookID = '".$bookid."'";
                $result = $conn->query($sql) or die($conn->error);
                while ( $review = $result->fetch_assoc()){
                    echo "<div class=\"review-block\">
                        <div id=\"rev-img\">";
                            if($review["pict"]==NULL){
                                echo"<img src=\"../img/profile-picture-blank.png\" alt=\"ini foto\">";
                            }else{
                                echo"<img src=\"../img/".$review["pict"]."\" alt=\"ini foto\">";
                            }
                        echo"</div>
                        <div id=\"comment\">
                            <h2>@".$review["username"]."</h2>
                            <p>".$review["review"]."</p>
                        </div>
                        <div id=\"rev-star\">
                            <img src=\"../img/star-on.png\" alt=\"ini bintang\">
                            <p>".$review["rating"]."/5</p>
                        </div>
                    </div>";
                } 
            ?>
        </div>

        <?php 
        if (sizeof($recommendation) > 0){
            echo "
            <div class='recommendation-section'>
                <h2 id='review'>Recommendation</h2>
                <h3>".$recommendation['title']."</h3>
                <img class='book-thumb' src='".$recommendation['title']."'/>
                <p>".$recommendation['description']."</p>
            </div>

            <form action='detail.php' method='GET'>
                <input type='hidden' id='".$recommendation['id']."' name='bookid' value='".$recommendation['id']."'>
                <input target='_blank' id='detail-btn' type='submit' value='Detail'>
            </form>
            ";
        } 
        ?>

    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="grid-container">
                <div id="payment">
                    <img src="../img/60-Payments.png">
                </div>
                <div class="grid-item">
                    <h3>Pemesanan Berhasil !</h3>
                    <p id="modal-message">Nomor Transaksi : </p>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal-fail" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="closeModalFail()">&times;</span>
            <div class="grid-container">
                <div id="payment">
                    <img src="../img/cross.png">
                </div>
                <div class="grid-item">
                    <h3>Pemesanan Gagal!</h3>
                    <p id="modal-message-fail"></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>