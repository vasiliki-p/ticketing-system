
       // Ακούστε για το πάτημα του εικονιδίου αναζήτησης
       document.getElementById("search-icon").addEventListener("click", function() {
        // Υποβολή της φόρμας όταν γίνει κλικ στο εικονίδιο
        document.getElementById("search-form").submit();
    });

    // Ακούστε για το πάτημα του πλήκτρου Enter στο πεδίο αναζήτησης
    document.getElementById("search").addEventListener("keyup", function(event) {
        // Ελέγξτε αν το πλήκτρο που πατήθηκε είναι το Enter (κωδικός 13)
        if (event.key === "Enter") {
            // Αν ναι, υποβάλετε τη φόρμα
            document.getElementById("search-form").submit();
        }
    });
