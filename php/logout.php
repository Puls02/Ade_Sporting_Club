<?php
    session_start();
    $host='127.0.0.1';
    $port='5432';
    $dbname='Ade_Sporting_Club';
    $user='postgres';
    $password='eleonora';

    $conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    if(!$conn){
        die("Errore nella connessione a PostgreSQL");
    }

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
