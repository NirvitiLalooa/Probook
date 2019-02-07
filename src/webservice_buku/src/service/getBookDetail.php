<?php
	//WSDL location
	$wsdl ="http://localhost:8888/ws/bookservice?wsdl";
	//create soap client
	$client = new SoapClient($wsdl, array('trace'=>1));
    
    // $id = $_POST["id"];
	// $request_param = $id;
	//specific service call
	try
	{
	    $response = $client->buyBook('2A9iDwAAQBAJ', 5, 'GAR1HCIGAR1HCI');
		header('Content-Type: application/json');
		echo $response;
	} 
	catch (Exception $e) 
	{ 
		echo "<h2>Exception Error!</h2>"; 
		echo $e->getMessage(); 
	}
?>


