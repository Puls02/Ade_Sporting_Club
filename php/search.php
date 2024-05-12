<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['id'];
    $searchTerm = pg_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM Utente WHERE NOT id = '{$outgoing_id}' AND (nome ILIKE '%{$searchTerm}%' OR cognome ILIKE '%{$searchTerm}%') ";
    $output = "";
    $query = pg_query($conn, $sql);

    if (pg_num_rows($query) > 0) {
        include_once "data.php";
    } else {
        $output .= 'Nessun utente trovato relativo al termine di ricerca';
    }
    echo $output;
?>
