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
    $data=$_POST['data'];
    $ora=$_POST['ora'];
    $ora_inizio=explode("-",$ora)[0];
    $ora_fine=explode("-",$ora)[1];
    // me li dividi poi in orario di inizio e orario di fine :)
    $campo=$_POST['campo'];
    $id_campo=explode("_",$campo)[1];
    
    if(isset($_POST['prenotazione'])){
        $prenotazione=$_POST['prenotazione'];
        if($prenotazione=="interoCampo"){
            $completa=true;
            if(explode("_",$campo)[0]=="calcetto"){
                $numePersone=10;
            }
            if(explode("_",$campo)[0]=="paddle"){
                $numePersone=4;
            }
            if(explode("_",$campo)[0]=="tennis"){
                $numePersone=4;
            }
            if(explode("_",$campo)[0]=="basket"){
                $numePersone=10;
            }
        }
    }
    echo $id, $data, $ora_inizio, $ora_fine, $campo, $prenotazione;
    /*
    $query = "INSERT INTO Prenotazione (campo,data,ora,utente,completa,numpersone) VALUES ('$doc1','$doc2') RETURNING id";
    $result = pg_query($conn, $query);
    
    */

?>