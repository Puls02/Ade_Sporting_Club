<?php
    session_start();
    //Connection
    include_once "config.php";

    //I retrieve the booking data
    $id=$_SESSION['id'];
    $data=$_POST['data'];
    $ora=$_POST['ora'];
    $ora_inizio=explode("-",$ora)[0];
    $ora_fine=explode("-",$ora)[1];
    $campo=$_POST['campo'];
    $id_campo=explode("_",$campo)[1];
    $sport=explode("_",$campo)[0];

    // Check if the user already has a reservation in that slot
    $query="SELECT * FROM prenotazione WHERE data='$data' and ora_inizio='$ora_inizio' and ora_fine='$ora_fine' and utente='{$_SESSION['id']}'";
    $result= pg_query($conn, $query);
    $num_rows=pg_num_rows($result);
    if($num_rows>0){
        $_SESSION['message'] = "hai già una prenotazione in questo slot!";
        pg_close($conn);
        header("Location: ../Prenota.php");
        exit();
    }

    if($sport!='palestra' && $sport!='piscina'){
        
        //I check if there is already a full reservation
        $query="SELECT * FROM prenotazione WHERE sport='$sport' and data='$data' and owner='true' and ora_inizio='$ora_inizio' and ora_fine='$ora_fine' and completa='true' and campo='$id_campo'";
        $result= pg_query($conn, $query);
        $num_rows=pg_num_rows($result);
        if($num_rows>0){
            $_SESSION['message'] = "Lo slot selezionato è già occupato!";
            pg_close($conn);
            header("Location: ../Prenota.php");
            exit();
        }
        //I check what type of booking is made
        $prenotazione=$_POST['prenotazione'];
        //I'm looking for incomplete reservations
        $query="SELECT * FROM prenotazione WHERE sport='$sport' and data='$data' and owner='true' and ora_inizio='$ora_inizio' and ora_fine='$ora_fine' and completa='false' and campo='$id_campo'";
        $result= pg_query($conn, $query);
        $num_rows=pg_num_rows($result);
        if($num_rows>0){
            $row=pg_fetch_assoc($result); 
            if($prenotazione=="interoCampo"){
                $query= "DELETE FROM prenotazione WHERE id_prenotazione='{$row['id_prenotazione']}'";
                $result= pg_query($conn, $query);
            } else{
                $_SESSION['message'] = "Lo slot selezionato è già occupato!";
                pg_close($conn);
                header("Location: ../Prenota.php");
                exit();
            }
        }    
    } else {
        $query="SELECT * FROM prenotazione WHERE sport='$sport' and data='$data' and ora_inizio='$ora_inizio' and ora_fine='$ora_fine'";
        $result= pg_query($conn, $query);
        $num_rows=pg_num_rows($result);
        if($num_rows>=10){
            $_SESSION['message'] = "Lo slot che hai selezionato è pieno!";
            pg_close($conn);
            header("Location: ../Prenota.php");
            exit();
        }
    }
    
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
        //cancel the transaction if any error occurs
        pg_query($conn, "ROLLBACK");
        die("Errore nella registrazione Utente!" . pg_last_error($conn));
    }
    
    pg_close($conn);

    $_SESSION['conferma'] = "La prenotazione è andata a buon fine!";

    header("Location: ../Prenota.php");
    exit();
    
?>