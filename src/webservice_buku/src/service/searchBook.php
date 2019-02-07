<?php
	//WSDL location
	$wsdl ="http://localhost:8888/ws/bookservice?wsdl";
    
	$client = new SoapClient($wsdl, array('trace'=>1));
	$title = $_GET["title"];
	//specific service call
	try
	{
		$response = $client->searchBook($title, 0, 10);
		header('Content-Type: application/json');
		echo $response;
	} 
	catch (Exception $e) 
	{ 
		echo "Exception Error!"; 
		echo $e->getMessage(); 
	}
?>
