<?php
    session_start();
    include_once "config.php";

    $id=$_SESSION['id'];

    $query = "UPDATE utente SET status = FALSE WHERE id='$id'";
    $result = pg_query($conn, $query);

     // Avvia la sessione
    session_unset(); // Cancella tutte le variabili di sessione
    session_destroy(); // Distrugge la sessione

    
    // Reindirizza alla pagina di login
    header("Location: ../index.php");
    exit;
    
?>
