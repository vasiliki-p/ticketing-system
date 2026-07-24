<?php
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

// Check if an ID is provided in the URL
if(isset($_GET['id']) && !empty(trim($_GET['id']))){
    $id = $_GET['id'];


    if($stmt = $conn->prepare("SELECT * FROM requests WHERE id = ?")){
        // Bind the parameter
        $stmt->bind_param("i", $param_id);

        // Set the parameter
        $param_id = trim($_GET['id']);

        // Execute the statement
        if($stmt->execute()){
            // Store the result
            $result = $stmt->get_result();

            if($result->num_rows == 1){
                // Fetch the row
                $row = $result->fetch_assoc();

            } else{
                // No request found with the provided ID
                echo "Δεν βρέθηκε αίτημα.";
            }
        } else{
            echo "Συνέβη κάποιο λάθος.Παρακαλώ ξαναπροσπαθήστε";
        }
    } else {
        // Error message if prepare statement fails
        echo "Συνέβη κάποιο λάθος.Παρακαλώ ξαναπροσπαθήστε";
    }

    // Close the statement
    $stmt->close();
} else {
    // Error message if no ID provided in URL
    echo "Δε βρέθηκε ID αιτήματος.";
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Καταχώρηση Αιτήματος</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      .request-form {
            overflow: auto;
        }
        .request-form input[type="submit"],
        .request-form button[type="submit"] {
            float: right;
            margin-left: 10px;
        }
    </style>
</head>
<body> 
    <div class="request-form">
    <h1>Λεπτομέρειες Αιτήματος</h1>
    
       <form action='process_response.php' method='post'>
       <input type='hidden' name='request_id' <?php echo $row['id'] ;?> >
       <div class="rounded-md shadow-sm -space-y-px"></div>
       <p><strong>Ονοματεπώνυμο:</strong> <?php echo $row['name'] ;?></p>
       <p><strong>Email:</strong> <?php echo $row['email'] ;?></p>
       <p><strong>Αίτημα:</strong> <?php echo $row['request'] ;?></p>
       <input type="submit" value="Καταχώρηση">
       </form> 

       <form action='logout.php' method='post'>
       <input type='submit'value='Αποσύνδεση'>
       </form> 

       <form action='process_response.php' method='post'>
       <h2>Απάντηση</h2>
       <textarea name='response' rows='23' cols='180'></textarea>
       </form> 

    </div>
</body>
</html>