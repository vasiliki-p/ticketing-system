<?php
include 'delete dep css.html';

$servername = "localhost";
$username = "admin";
$password = "B@kal@r05";
$dbname = "register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Διαγραφή</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="stylesheet" type="text/css" >
</head>
<body>  
<div class="reg-form">
    <h2><strong>Διαγραφή Τμήματος</strong></h2>
    <p></p>
    <form id="reg-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="delete_request">Όνομα Τμήματος:</label>
        <input type="text" name="delete_request" required>
        <div style="text-align: center;"> 
        <input type="submit" name="delete_request" value="Διαγραφή">
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Κώδικας για καταχώρηση εταιρείας
    }
    
    if (isset($_POST['delete_request'])) {
        $delete_request = $_POST['delete_request'];

        $sql = "DELETE FROM requests WHERE delete_request=?";

        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("s", $delete_request);

        if ($stmt->execute()) {
            echo "Το τμήμα διαγράφηκε με επιτυχία.";
        } else {
            echo "Σφάλμα κατά τη διαγραφή του τμήματος: " . $stmt->error;
        }

        $stmt->close();
    }
}
$conn->close();
?>

</body>
</html>
