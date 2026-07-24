function updateCompleted(checkbox, id) {
    var completed = checkbox.checked ? 1 : 0;

    // Παράδειγμα AJAX ερώτησης
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Επιτυχής αποθήκευση στη βάση δεδομένων
            console.log("Η κατάσταση του αιτήματος ενημερώθηκε επιτυχώς.");
        }
    };
    xhttp.open("GET", "update_completed.php?id=" + id + "&completed=" + completed, true);
    xhttp.send();
}