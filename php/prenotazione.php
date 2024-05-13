<?php
    session_start();
    //connessione
    $host='127.0.0.1';
    $port='5432';
    $dbname='Ade_Sporting_Club';
    $user='postgres';
    $password='Sporting77!';
    
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    
    if (!$conn) {
        die("Errore nella connessione a PostgreSQL");
    }
    //recupero i dati della prenotazione
    $id=$_SESSION['id'];
    $date=$_POST['data'];
    $ora=$_POST['ora'];
    if(isset($_POST['campo'])){
        $campo=$_POST['campo'];
    }
    $prenotazione=$_POST['prenotazione'];
    


?>