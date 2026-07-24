function deleteRequest(id) {
    if (confirm("Είστε σίγουρος ότι θέλετε να διαγράψετε αυτό το αίτημα;")) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Check for successful response
                if (this.responseText === "success") {
                    console.log("Το αίτημα διαγράφηκε επιτυχώς.");
                    window.location.reload();
                } else {
                    console.error("Σφάλμα κατά τη διαγραφή του αιτήματος: " + this.responseText);
                }
            }
        };
        xhttp.open("GET", "delete_request.php?id=" + id, true);
        xhttp.send();
    }
}

