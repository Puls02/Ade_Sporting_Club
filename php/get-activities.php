<?php
// Avvia la sessione
session_start();
// Connessione al database
include_once "config.php";

// Imposta la localizzazione in italiano
setlocale(LC_TIME, 'it_IT.UTF-8');

$daysOfWeekMap = array(
    'Monday' => 'lunedi',
    'Tuesday' => 'martedi',
    'Wednesday' => 'mercoledi',
    'Thursday' => 'giovedi',
    'Friday' => 'venerdi',
    'Saturday' => 'sabato',
    'Sunday' => 'domenica'
);

// Recupera la data selezionata (passata come parametro GET)
if(isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Debug: stampa il valore del parametro 'date'
    error_log("Parametro 'date' ricevuto: " . $selectedDate);

    // Sanitizza il parametro per evitare SQL injection
    $selectedDate = filter_var($selectedDate, FILTER_SANITIZE_STRING);

    // Verifica che la data sia in un formato corretto
    $dateObject = DateTime::createFromFormat('Y-m-d', $selectedDate);
    if ($dateObject !== false) {
        // Get the day of the week in English
        $dayOfWeekEnglish = $dateObject->format('l');
        // Map the day of the week to Italian
        $dayOfWeekItalian = $daysOfWeekMap[$dayOfWeekEnglish];

        // Esegui la query per recuperare i dati delle attività per la data selezionata
        $result = pg_query_params($conn, "SELECT * FROM prenotazione WHERE utente = $1 AND data = $2", array($_SESSION['id'], $selectedDate));
        $result2 = pg_query_params($conn,"SELECT o.Nome AS nome, o.categoria AS categoria, o.giorno_settimana AS giorno, o.ora_inizio AS OraInizio, o.ora_fine AS OraFine FROM Utente u JOIN Cliente c ON u.ID = c.ID JOIN Sottoscrizione s ON c.ID = s.Cliente JOIN Prevede p ON s.Abbonamento = p.Abbonamento JOIN Orari o ON p.Corso = o.Nome WHERE u.ID = $1 AND o.giorno_settimana = '".$dayOfWeekItalian."'", array($_SESSION['id']));

        if ($result && $result2) {
            $activities = array();
            // Fetch dei risultati della prima query e salvataggio in un array
            while ($row = pg_fetch_assoc($result)) {
                $activities[] = $row;
            }
            // Fetch dei risultati della seconda query e salvataggio nello stesso array
            while ($row = pg_fetch_assoc($result2)) {
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
