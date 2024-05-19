<?php
// Connessione al database
include_once "config.php";

// Recupera la data selezionata (passata come parametro GET)
if(isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Esegui la query per recuperare i dati delle attività per la data selezionata
    $result = pg_query_params($conn, "SELECT corso, giorno, orarioinizio, orariofine FROM attivita WHERE giorno = $1", array($selectedDate));

    // Controlla se ci sono risultati
    if ($result) {
        $activities = array();
        // Fetch dei risultati e salvataggio in un array
        while ($row = pg_fetch_assoc($result)) {
            $activities[] = $row;
        }
        // Restituisci i dati delle attività come JSON
        echo json_encode($activities);
    } else {
        echo "Nessuna attività trovata per la data selezionata.";
    }
} else {
    echo "Parametro 'date' mancante nella richiesta.";
}

// Chiudi la connessione al database
pg_close($conn);
?>