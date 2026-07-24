<?php
<<<<<<< HEAD
include 'restricted.php';
=======
>>>>>>> fdcf3ac0bc7103ec101333d572ddae28c826284b
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
    <h1>Διαγραφή Τμήματος</h1>
    
    <form id="reg-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="delete_dep_name">Όνομα Τμήματος:</label>
        <input type="text" name="delete_dep_name" placeholder="Όνομα Τμήματος" required>
        <div style="text-align: center;"> 
        <input type="submit" name="delete_dep" value="Διαγραφή">
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Κώδικας για καταχώρηση εταιρείας
    }
    
    if (isset($_POST['delete_dep'])) {
        $delete_dep_name = $_POST['delete_dep_name'];

        $sql = "DELETE FROM department WHERE department_name=?";

        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("s", $delete_dep_name);

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
