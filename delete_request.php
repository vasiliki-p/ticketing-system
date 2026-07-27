<?php
include 'restricted.php';
include 'connection.php'; 
include 'delete dep css.html';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Διαγραφή Αιτήματος</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="stylesheet" type="text/css" >
</head>
<body>  
<div class="reg-form">
    <h1>Διαγραφή Αιτήματος</h1>
    
    <form id="reg-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="delete_request_id">ID Αιτήματος:</label>
        <input type="number" name="delete_request_id" placeholder="π.χ. 22" required>
        <div style="text-align: center;"> 
            <input type="submit" name="delete_request" value="Διαγραφή">
        </div>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_request'])) {
        $delete_request_id = intval($_POST['delete_request_id']); // Μετατροπή σε αριθμό (int)

        $sql = "DELETE FROM requests WHERE id=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $delete_request_id);

        if ($stmt->execute()) {
             if ($stmt->affected_rows > 0) {
                echo "<p style='text-align: center; color: green;'>Το αίτημα διαγράφηκε με επιτυχία.</p>";
            } else {
                echo "<p style='text-align: center; color: red;'>Δεν βρέθηκε αίτημα με αυτό το ID.</p>";
            }
        } else {
            echo "<p style='text-align: center; color: red;'>Σφάλμα κατά τη διαγραφή του αιτήματος: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}
$conn->close();
?>

</body>
</html>
