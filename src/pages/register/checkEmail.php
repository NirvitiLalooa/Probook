<?php 
include '../../database/connect.php';
$email = $_POST["email"];

$exist = true;
$sql = "SELECT email FROM Users";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  if($email == $row["email"]){
    $exist = false;
  }
}

if ($email == "")
  $exist = false;

$conn->close();
echo $exist;
?>
