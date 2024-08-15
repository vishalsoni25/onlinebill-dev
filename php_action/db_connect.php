<?php 	

$localhost = "sql208.infinityfree.com";
$username = "if0_36535169";
$password = "KOWSw5MBeJT19n";
$dbname = "if0_36535169_roughbilling";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>