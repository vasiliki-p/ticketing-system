<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  font-size: 17px;
}

.active {
  background-color: #04AA6D;
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
  <a href="#home" class="active">Home</a>
  <a href="#news">Αιτήματα</a>
  <a href="#contact">Απαντήσεις</a>
  <div class="dropdown">
    <button class="dropbtn">Καταχωρήσεις </button>
    <div class="dropdown-content">
      <a href="#">Χρήστης</a>
      <a href="#">Εταιρεία</a>
      <a href="#">Τμήμα</a>
    </div>
  </div> 
  <a href="#about">Αποσύνδεση</a>
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
</script>

</body>
</html>
