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
    $sport=explode("_",$campo)[0];
    
    if(isset($_POST['prenotazione'])){
        $prenotazione=$_POST['prenotazione'];
        if($prenotazione=="interoCampo"){
            $completa=true;
            $query = "INSERT INTO Prenotazione (campo,data,ora_inizio,ora_fine,utente,completa,sport) VALUES ('$id_campo','$data','$ora_inizio','$ora_fine','$id','true','$sport')";
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
            $query = "INSERT INTO Prenotazione (campo,data,ora_inizio,ora_fine,utente,completa,num_persone,sport) VALUES ('$id_campo','$data','$ora_inizio','$ora_fine','$id','false','$numPersone','$sport')";
            $result = pg_query($conn, $query);
        }
    }

    if($sport=="piscina" || $sport=="palestra"){
        $query = "INSERT INTO Prenotazione (campo,data,ora_inizio,ora_fine,utente,completa,sport) VALUES ('$id_campo','$data','$ora_inizio','$ora_fine','$id','true','$sport')";
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