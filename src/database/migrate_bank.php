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
    $sql = "CREATE DATABASE bank";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
    echo"<br>";
    $conn->close();
?>

<!-- Reconnect, now access the created database -->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "bank";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

<?php
    // Create tables
    $sql = "CREATE TABLE IF NOT EXISTS Customer (
        customerID INT AUTO_INCREMENT NOT NULL,
        name VARCHAR(20) NOT NULL,
        bankAccount VARCHAR(15) NOT NULL,
        balance DECIMAL(13, 2) NOT NULL,
        PRIMARY KEY (customerID)
    );";
    $sql .= "CREATE TABLE IF NOT EXISTS Purchase (
        purchaseID INT AUTO_INCREMENT NOT NULL,
        senderAccount VARCHAR(15) NOT NULL,
        receiverAccount VARCHAR(15) NOT NULL,
        amount DECIMAL(13, 2),
        PRIMARY KEY (purchaseID)
    );";
?>

<?php
    $sql .= "INSERT INTO Users (name, bankAccount, balance)
    VALUES ('John Doe','J0HND03J0HND03', 30000);";
    $sql .= "INSERT INTO Users (name, bankAccount, balance)
    VALUES ('Rifo Ahmad Genadi', 'GAR1HCIGAR1HCI', 100000000);";
    $sql .= "INSERT INTO Purchase (senderAccount, receiverAccount, amount)
    VALUES ('J0HND03J0HND03', 'GAR1HCIGAR1HCI', 50000);";

    if ($conn->multi_query($sql) === TRUE) {
        echo "New tables created successfully"; echo"<br>";
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    echo"<br>";

    $conn->close();
?>