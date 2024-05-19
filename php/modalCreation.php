<?php

// Connessione al database
include_once "config.php";

$id = $_POST['id'];
$result = pg_query($conn, "SELECT * FROM prenotazione WHERE id_prenotazione = $id");
if ($result) {
    $row = pg_fetch_assoc($result);
    echo json_encode([
        'id' => $row['id_prenotazione'],
        'sport' => $row['sport'],
        'campo' => $row['campo'],
        'num_persone' => $row['num_persone']
    ]);
} else {
    echo json_encode(['message' => 'Prenotazione non trovata.']);
}


?>
