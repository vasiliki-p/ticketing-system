<?php

include 'connection.php';

$data = array();

if (isset($_GET['q'])) {
    $search_query = $_GET['q'];
    $sql = "SELECT * FROM company WHERE company_name LIKE '%" . $conn->real_escape_string($search_query) . "%'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
}

echo json_encode($data);

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.8">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    
    <style>
    body {margin:0;font-family:Arial}

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
        font-size: 17px;}

      
      .active {
        background-color: #4caf50;
        color: white;
      }
      
      .homepage .icon {
        display: none;
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
      
      .homepage #search {
        padding: 8px 16px;
        float: right;
    width: auto;
    margin-top: 5px;
     border: 1px solid rgba(0, 0, 0, 0.25) ;
    border-radius: 25px;
    display: block;
    outline: 0;
    margin-right: 200px; /* Προσθέστε απόσταση μεταξύ των πεδίων */
}
.homepage #logout{
        position: fixed;
        right: 0px;
        top: 0px;
        background-color: #aa0428;
        color: white;
        display: block;

        }

        .main {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Επιθυμητό ύψος για κέντραρισμα κατακόρυφα */
    font-size: 30px;
}

    .main * {
    text-align: center; /* Κεντράρει κάθε στοιχείο μέσα στην .main οριζόντια */
    }
      .main a {  
              float: left;
              display: block;
              color: #333;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
              font-size: 17px;
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
  <a href="./user.php" class="active">Αρχική Σελίδα</a>
  <div class="dropdown">
    <button class="dropbtn">Αιτήματα </button>
    <div class="dropdown-content">
      <a href="./request_form.php">Δημιουργία Αιτήματος</a>
      <a href="./my_requests.php">Τα  Αιτήματά μου</a>
    </div>
  </div>
  <a href="./my_answers.php">Απαντήσεις</a>
  <input id=search type="text" placeholder="Search.." autocomplete="off">
  <a href="./logout.php" id="logout">Αποσύνδεση</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
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
function filterContent() {
  var input, filter, ul, li, txtValue;
  input = document.getElementById('search');
  filter = input.value.toUpperCase();
  ul = document.getElementById("list");

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var response = JSON.parse(this.responseText);
      ul.innerHTML = '';
      for (var i = 0; i < response.length; i++) {
        txtValue = response[i].company_name; // Αντικαταστήστε το company_name με το πεδίο που θέλετε να αναζητήσετε
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          var li = document.createElement("li");
          li.textContent = txtValue;
          ul.appendChild(li);
        }
      }
    }
  };
  xhttp.open("GET", "search.php?q=" + filter, true);
  xhttp.send();
}

</script>
 

</body>
</html>

