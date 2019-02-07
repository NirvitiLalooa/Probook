<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";

    // Create database
    $sql = "CREATE DATABASE book_ws";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $conn->close();
?>

<!-- Reconnect, now access the created database -->
<?php $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "book_ws";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


?>

<?php
    // Create tables
    $sql = "CREATE TABLE `authors` (
        `book_id` varchar(20) NOT NULL,
        `author_name` varchar(200) NOT NULL
      );";

    $sql .= "CREATE TABLE `books` (
        `id` varchar(20) NOT NULL,
        `title` varchar(2000) NOT NULL,
        `subtitle` varchar(10000) NOT NULL,
        `publisher` varchar(200) NOT NULL,
        `publish_date` varchar(20) NOT NULL,
        `description` varchar(20000) NOT NULL,
        `imageUrl` varchar(2083) NOT NULL,
        `price` int(11) NOT NULL
    );";

    $sql .= "CREATE TABLE `categories` (
        `book_id` varchar(20) NOT NULL,
        `category` varchar(1000) NOT NULL
    );";

    $sql .= "CREATE TABLE `orders` (
        `order_id` int(11) NOT NULL,
        `book_id` varchar(20) NOT NULL,
        `quantity` int(11) NOT NULL,
        `total_price` int(11) NOT NULL
    );";

    if ($conn->multi_query($sql) === TRUE) {
        echo "New tables created successfully"; echo"<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo"<br>";

    $conn->close();

?>