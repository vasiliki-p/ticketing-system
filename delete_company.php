<?php
include 'restricted.php';
include 'connection.php';
include 'delete dep css.html';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Διαγραφή Εταιρείας</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <link rel="stylesheet" type="text/css" >
</head>
<body>  
<div class="reg-form">
    <h1>Διαγραφή Εταιρείας</h1>
    
    <form id="reg-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <label for="delete_company_code">Κωδικός Εταιρείας:</label>
        <input type="text" name="delete_company_code" placeholder="π.χ. 001" required>
        <div style="text-align: center;"> 
            <input type="submit" name="delete_company" value="Διαγραφή">
        </div>
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_company'])) {
        $delete_company_code = $_POST['delete_company_code'];

        $sql = "DELETE FROM company WHERE company_code=?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $delete_company_code);

        if ($stmt->execute()) {
             if ($stmt->affected_rows > 0) {
                echo "<p style='text-align: center; color: green;'>Η εταιρεία διαγράφηκε με επιτυχία.</p>";
            } else {
                echo "<p style='text-align: center; color: red;'>Δεν βρέθηκε εταιρεία με αυτόν τον κωδικό.</p>";
            }
        } else {
            echo "<p style='text-align: center; color: red;'>Σφάλμα κατά τη διαγραφή της εταιρείας: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}
$conn->close();
?>

</body>
</html>
