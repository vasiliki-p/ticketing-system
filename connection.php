<?php
/*
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
//echo "Connected successfully";*/
?>


<?php
// Παίρνουμε το URL από το Render, αν υπάρχει
$db_url = getenv("DATABASE_URL");

if ($db_url) {
    // Είμαστε στο Render: "Σπάμε" το URL στα κομμάτια του
    $dbparts = parse_url($db_url);
    
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'], '/');
    $port = $dbparts['port'];
} else {
    // Είμαστε τοπικά (XAMPP/WAMP): Βάλε εδώ τα παλιά σου στοιχεία
$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";
   $port = 3306;
}

// Δημιουργία σύνδεσης
$conn = new mysqli($hostname, $username, $password, $database, $port);

// Έλεγχος σύνδεσης
if ($conn->connect_error) {
    die("Η σύνδεση απέτυχε: " . $conn->connect_error);
}
?>
