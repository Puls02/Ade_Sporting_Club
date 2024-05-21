<?php
// Avvia la sessione
session_start();
// Connessione al database
include_once "config.php";

// Recupera la data selezionata (passata come parametro GET)
if(isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Debug: stampa il valore del parametro 'date'
    error_log("Parametro 'date' ricevuto: " . $selectedDate);

    // Sanitizza il parametro per evitare SQL injection
    $selectedDate = filter_var($selectedDate, FILTER_SANITIZE_STRING);

    // Verifica che la data sia in un formato corretto
    if (DateTime::createFromFormat('Y-m-d', $selectedDate) !== false) {
        // Esegui la query per recuperare i dati delle attività per la data selezionata
        $result = pg_query_params($conn, "SELECT * FROM prenotazione WHERE utente = $1 AND data = $2", array($_SESSION['id'], $selectedDate));


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
            error_log("Errore nella query: " . pg_last_error($conn));
            echo json_encode(array("error" => "Nessuna attività trovata per la data selezionata."));
        }
    } else {
        echo json_encode(array("error" => "Formato data non valido."));
    }
} else {
    // Debug: stampa un messaggio di errore se il parametro 'date' manca
    error_log("Parametro 'date' mancante nella richiesta.");
    echo json_encode(array("error" => "Parametro 'date' mancante nella richiesta."));
}

// Chiudi la connessione al database
pg_close($conn);
?>
