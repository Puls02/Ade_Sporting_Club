<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['id'];
    $sql = "SELECT * FROM Utente WHERE NOT id = '{$outgoing_id}'";
    $query = pg_query($conn, $sql);
    $output = "";

    if (pg_num_rows($query) == 0) {
        $output .= "Nessun utente disponibile per la chat";
    } elseif (pg_num_rows($query) > 0) {
        include_once "data.php";
    }

    echo $output;
?>
