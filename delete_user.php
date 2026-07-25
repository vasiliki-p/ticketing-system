<?php
include 'restricted.php';
include 'connection.php';
include 'delete dep css.html';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Διαγραφή Χρήστη</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="stylesheet" type="text/css" >
</head>
<body>  
<div class="reg-form">
    <h1>Διαγραφή Χρήστη</h1>
    
    <form id="reg-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="delete_username">Όνομα Χρήστη (Username):</label>
        <input type="text" name="delete_username" placeholder="π.χ. vpoupouza" required>
        <div style="text-align: center;"> 
            <input type="submit" name="delete_user" value="Διαγραφή">
        </div>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_user'])) {
        $delete_username = $_POST['delete_username'];

        $sql = "DELETE FROM users WHERE username=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_username);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo "<p style='text-align: center; color: green;'>Ο χρήστης διαγράφηκε με επιτυχία.</p>";
            } else {
                echo "<p style='text-align: center; color: red;'>Δεν βρέθηκε χρήστης με αυτό το Username.</p>";
            }
        } else {
            echo "<p style='text-align: center; color: red;'>Σφάλμα κατά τη διαγραφή του χρήστη: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}
$conn->close();
?>

</body>
</html>
