<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
    body {
            margin: 0;
            font-family: Arial;
            background-color: #f4f4f4;
        }

    .homepage {
        overflow: hidden;
        background-color: #333;
      
    }
      
      .homepage a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
      }
      
      .active {
        background-color: #4caf50;
        color: white;
      }
      
      .homepage .icon {
        display: none;
      }
      
      .homepage #logout{
        position: fixed;
        right: 0px;
        top: 0px;
        background-color: #aa0428;
        color: white;
        }

      .dropdown {
        float: left;
        overflow: hidden;
      }
      
      .dropdown .dropbtn {
        font-size: 17px;    
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
      }
      
      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
      }
      
      .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
      }
      
      .homepage a:hover, .dropdown:hover .dropbtn {
        background-color: #555;
        color: white;
      }
      
      .dropdown-content a:hover {
        background-color: #ddd;
        color: black;
      }
      
      .dropdown:hover .dropdown-content {
        display: block;
      }

        .request-container {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .request-container h1 {
            margin-bottom: 20px;
            font-weight: bold; /* Προσθέστε το bold στον τίτλο */
            float: center;
            
        }

        .request-container p {
            margin-bottom: 5px;
        }
        
        .request-box {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .request-container h3 {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .request-box p {
            margin-bottom: 5px;
        }
        
        .request-container a:link {
            color: blue;
            background-color: transparent;
            text-decoration: underline;
        }

        .request-container a:visited {
            color: purple;
            background-color: transparent;
            text-decoration: underline; 
        }
        
        .request-container a:hover {
            color: red;
            background-color: transparent;
            text-decoration: underline;
        }

      @media screen and (max-width: 600px) {
        .homepage a:not(:first-child), .dropdown .dropbtn {
          display: none;
        }
        .homepage a.icon {
          float: right;
          display: block;
        }
      }
      
      @media screen and (max-width: 600px) {
        .homepage.responsive {position: relative;}
        .homepage.responsive .icon {
          position: absolute;
          right: 0;
          top: 0;
        }
        .homepage.responsive a {
          float: none;
          display: block;
          text-align: left;
        }
        .homepage.responsive .dropdown {float: none;}
        .homepage.responsive .dropdown-content {position: relative;}
        .homepage.responsive .dropdown .dropbtn {
          display: block;
          width: 100%;
          text-align: left;
        }
      }
</style>
</head>
<body>
     
<div class="homepage" id="myhomepage">
  <a href="./admin.php" >Αρχική Σελίδα</a>
  <a href="./requests.php" class="active">Αιτήματα</a>
  <a href="./answers_list.php">Απαντήσεις</a>
  <div class="dropdown">
    <button class="dropbtn">Καταχωρήσεις </button>
    <div class="dropdown-content">
      <a href="./user_registration.php">Χρήστης</a>
      <a href="./company.php">Εταιρεία</a>
      <a href="./department.php ">Τμήμα</a>
    </div>
  </div> 
  <div class="dropdown">
    <button class="dropbtn">Διαγραφή</button>
    <div class="dropdown-content">
        <a href="./delete_user.php">Χρήστης</a>
        <a href="./delete_company.php">Εταιρεία</a>
        <a href="./delete_department.php">Τμήμα</a>
        <a href="./delete_request.php">Αίτημα</a>
    </div>
  </div>
  <div class="request-container">
    <h1>Αιτήματα</h1>
    <?php
    // Query to select titles from requests table
    
    $sql = "SELECT id, name, email, title, completed FROM requests ORDER BY created_at DESC";
    $result = $conn->query($sql);
    
  // Output data of each row
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<div>";
          echo "<h3><a href='request-container.php?id=" . $row["id"]. "'>" . $row["title"]. "</a>";
          // Προσθήκη εικονιδίου διαγραφής
          echo "<a href='delete_request.php?id=" . $row["id"] . "' style='margin-left: 10px;'><i class='fas fa-trash-alt'></i></a>";
          echo "<span style='margin-left: 20px;'>"; // Προσθήκη ενδιάμεσου κενού
           // Έλεγχος αν το checkbox είναι επιλεγμένο ή όχι
          $checked = $row["completed"] == 1 ? "checked" : "";
          echo "<input type='checkbox' id='completed' name='completed' value='1' $checked onchange='updateCompleted(this, " . $row["id"] . ")'></h3></p>";
          echo "<div class='request-box'>";  
          echo "<p>Ονοματεπώνυμο: " . $row["name"]. "</p>";
          echo "<p>Email: " . $row["email"]. "</p>";
          echo "</div>";
          echo "</div>";
          echo "<p></p>";
      }
  } else {
      echo "Δεν βρέθηκαν αιτήματα.";
  }
  ?>
</div>

<script>
 function myFunction() {
  var x = document.getElementById("myhomepage");
  if (x.className === "homepage") {
    x.className += " responsive";
  } else {
    x.className = "homepage";
  }
}
</script>
 

</body>
</html>

