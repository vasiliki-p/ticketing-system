<?php 
include 'restricted.php';
include 'admin_menu.html';
include 'connection.php';

?>

include 'admin_menu.html';

$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>

