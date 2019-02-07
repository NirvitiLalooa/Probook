<?php
	//WSDL location
    $wsdl ="http://localhost:8888/ws/bookservice?wsdl";
    include '../../database/connect.php';
	//create soap client
	$client = new SoapClient($wsdl, array('trace'=>1));
    
    $bookID = $_POST["bookID"];
    $quantity = $_POST["amount"];
    $accNum = $_POST["userID"];
    $idBeneran = $_POST["beneranID"];
    
	//specific service call
	try
	{
	    $response = $client->buyBook($bookID, $quantity, $accNum);
        header('Content-Type: application/json');
        if($response == "1"){
            if($conn->connect_error){
                die($conn->connect_error);
            }
    
            $nowFormat = date('Y-m-d');
            $sql = "INSERT INTO orders(buyerID, bookID, amount, orderDate) VALUES ('".$_POST["beneranID"]."','".$_POST["bookID"]."','".$_POST["amount"]."','".$nowFormat."')";
            $result = $conn->query($sql);
            $last_id = $conn->insert_id;
            echo $last_id;
            $conn->close();
        } else {
            // failed transaction
            echo "Insufficient balance";
        }
	} 
	catch (Exception $e) 
	{ 
		echo "<h2>Exception Error!</h2>"; 
		echo $e->getMessage(); 
	}
?>

