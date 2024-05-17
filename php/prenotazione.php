<?php
    session_start();
    //connessione
    $host='127.0.0.1';
    $port='5432';
    $dbname='Ade_Sporting_Club';
    $user='postgres';
    $password='eleonora';
    
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
    $campo=$_POST['campo'];
    $id_campo=explode("_",$campo)[1];
    
    if(isset($_POST['prenotazione'])){
        $prenotazione=$_POST['prenotazione'];
        if($prenotazione=="interoCampo"){
            $completa=true;
            if(explode("_",$campo)[0]=="calcetto"){
                $numPersone=10;
            }
            if(explode("_",$campo)[0]=="paddle"){
                $numPersone=4;
            }
            if(explode("_",$campo)[0]=="tennis"){
                $numPersone=4;
            }
            if(explode("_",$campo)[0]=="basket"){
                $numPersone=10;
            }
        } else {
            $completa=false;
            if(explode("_",$campo)[0]=="calcetto"){
                $numPersone=$_POST['numeroPersone'];
            }
            if(explode("_",$campo)[0]=="paddle"){
                $numPersone=$_POST['numeroPersone'];
            }
            if(explode("_",$campo)[0]=="tennis"){
                $numPersone=$_POST['numeroPersone'];
            }
            if(explode("_",$campo)[0]=="basket"){
                $numPersone=$_POST['numeroPersone'];
            }
        }
    }

    $query = "INSERT INTO Prenotazione (campo,data,ora_inizio,ora_fine,utente,completa,num_persone) VALUES ('$id_campo','$data','$ora_inizio','$ora_fine','$id','$completa','$numPersone')";
    $result = pg_query($conn, $query);
    
    header("Location: ../Prenota.php");
    exit;
?>