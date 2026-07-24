<!DOCTYPE html>
<html>
<head>
    <title>
        <i class="fas fa-trash-alt"></i>
        Διαγραφή
    </title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="delete_dep_css.html">
</head>
<body>  
<div class="reg-form">
    <h1>Διαγραφή Αιτήματος</h1>
    <p></p>
    <form id="reg-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="delete_request">Θέμα Αιτήματος:</label>
        <input type="text" name="delete_request" required>
        <div style="text-align: center;"> 
        <input type="submit" name="delete_submit" value="Διαγραφή">
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_submit'])) {
        $delete_request = $_POST['delete_request'];

        $sql = "DELETE FROM requests WHERE title = ?";

        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("s", $delete_request);

        if ($stmt->execute()) {
            echo "Το αίτημα διαγράφηκε με επιτυχία.";
        } else {
            echo "Σφάλμα κατά τη διαγραφή του αιτήματος: " . $stmt->error;
        }

        $stmt->close();
    }
}
$conn->close();
?>

</body>
</html>
