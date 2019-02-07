<?php 
include '../../database/connect.php';
$username = $_POST["username"];

$exist = true;
$sql = "SELECT username FROM Users";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
  if($username == $row["username"]){
    $exist = false;
  }
}

if ($username == "")
  $exist = false;

$conn->close();
echo $exist;
?>
