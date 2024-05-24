<?php

    // Connessione al database
    include_once "config.php";

    $id_prenotazione=$_POST['id_prenotazione'];
    $user = $_POST['utente'];


    $query="SELECT * FROM prenotazione WHERE id_prenotazione=$id_prenotazione and utente=$user and owner=true";
    $result = pg_query($conn,$query);


    if(pg_num_rows($result)>0){
        $deleteQuery="DELETE FROM prenotazione WHERE id_prenotazione=$id_prenotazione";
        $result = pg_query($conn,$deleteQuery);
        echo json_encode(['success' => true, 'message' => 'Prenotazione eliminata con successo']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Non puoi eliminare le prenotazioni di cui non sei owner']);
    }

    pg_close($conn);

?>