<?php
    session_start();
    //connessione
    include_once "config.php";

    //recupero i dati della prenotazione
    $id=$_SESSION['id'];
    $data=$_POST['data'];
    $ora=$_POST['ora'];
    $ora_inizio=explode("-",$ora)[0];
    $ora_fine=explode("-",$ora)[1];
    $campo=$_POST['campo'];
    $id_campo=explode("_",$campo)[1];
    $sport=explode("_",$campo)[0];
    
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
                $numPersone=2;
            }
            if(explode("_",$campo)[0]=="basket"){
                $numPersone=10;
            }
            $query = "INSERT INTO Prenotazione (campo,data,ora_inizio,ora_fine,utente,completa,sport,owner,num_persone) VALUES ('$id_campo','$data','$ora_inizio','$ora_fine','$id','true','$sport','true','$numPersone')";
            $result = pg_query($conn, $query);
        } else {
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
            $query = "INSERT INTO Prenotazione (campo,data,ora_inizio,ora_fine,utente,completa,num_persone,sport, owner) VALUES ('$id_campo','$data','$ora_inizio','$ora_fine','$id','false','$numPersone','$sport','true')";
            $result = pg_query($conn, $query);
        }
    }

    if($sport=="piscina" || $sport=="palestra"){
        $query = "INSERT INTO Prenotazione (campo,data,ora_inizio,ora_fine,utente,completa,sport,owner) VALUES ('$id_campo','$data','$ora_inizio','$ora_fine','$id','true','$sport','true')";
        $result = pg_query($conn, $query);
    }
    
    if (!$result) {
        //annulla la transazine se si verifica qualche errore
        pg_query($conn, "ROLLBACK");
        die("Errore nella registrazione Utente!" . pg_last_error($conn));
    }
    
    header("Location: ../Prenota.php");
    exit;
?>