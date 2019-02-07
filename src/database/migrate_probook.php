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
    $sql = "CREATE DATABASE probook";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }

    $conn->close();
?>

<!-- Reconnect, now access the created database -->
<?php include 'connect.php'?>

<?php
    // Create tables
    $sql = "CREATE TABLE IF NOT EXISTS Users (
        userID INT AUTO_INCREMENT NOT NULL,
        username VARCHAR(20) NOT NULL,
        name VARCHAR(20) NOT NULL,
        password VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        bankAccount VARCHAR(15) NOT NULL,
        address VARCHAR(50),    
        phone VARCHAR(16),
        pict VARCHAR(300),
        PRIMARY KEY (userID),
        reg_date TIMESTAMP
    );";

    $sql .= "CREATE TABLE IF NOT EXISTS AccessToken (
        token VARCHAR(20) NOT NULL,
        expire DATETIME NOT NULL,
        userID INT NOT NULL,
        browser VARCHAR(200) NOT NULL,
        ipAddress VARCHAR(20) NOT NULL,
        PRIMARY KEY (token),
        FOREIGN KEY (userID) REFERENCES Users(userID)
    );";

    $sql .= "CREATE TABLE IF NOT EXISTS Orders (
        OrderID INT AUTO_INCREMENT NOT NULL,
        buyerID INT NOT NULL,
        bookID VARCHAR(30) NOT NULL,
        orderDate DATE NOT NULL,
        amount INT NOT NULL,
        rating INT,
        review VARCHAR(50),
        PRIMARY KEY (OrderID),
        FOREIGN KEY (buyerID) REFERENCES Users(userID)
    );";
?>

<?php
    $sql .= "INSERT INTO Users (username, name, password, email, bankAccount)
    VALUES ('johndoe2', 'John Doe', '12345678', 'john@example.com', 'J0HND03J0HND03');";
    $sql .= "INSERT INTO Users (username, name, password, email, bankAccount)
    VALUES ('rifoag', 'Rifo Ahmad Genadi', '12345677', '13516111@std.stei.itb.ac.id', 'GAR1HCIGAR1HCI');";

    if ($conn->multi_query($sql) === TRUE) {
        echo "New tables created successfully"; echo"<br>";
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo "<br>";

    $conn->close();
?>