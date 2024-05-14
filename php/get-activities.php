<?php
// Connessione al database
$conn = pg_connect("host=localhost dbname=Ade_Sporting_Club user=postgres password=Sporting77!");

if (!$conn) {
    echo "Errore di connessione al database.";
    exit;
}

// Query per ottenere le attività
$query = "SELECT * FROM attivita";
$result = pg_query($conn, $query);

if (!$result) {
    echo "Errore nella query al database.";
    exit;
}

// Prepara i dati delle attività come JSON
$activities = array();
while ($row = pg_fetch_assoc($result)) {
    $activities[] = $row;
}

echo json_encode($activities);

// Chiudi la connessione
pg_close($conn);
?>
