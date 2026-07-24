

function myFunction() {
  var x = document.getElementById("myhomepage");
  if (x.className === "homepage") {
    x.className += " responsive";
  } else {
    x.className = "homepage";
  }
}