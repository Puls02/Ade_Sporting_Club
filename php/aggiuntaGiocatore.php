<?php
session_start();

// Database connection
include_once "config.php";

$id_utente = $_SESSION['id'];
$id_prenotazione = $_POST['id'];

// Use parameterized query to avoid SQL Injection
$result = pg_query_params($conn, "SELECT * FROM prenotazione WHERE id_prenotazione = $1", array($id_prenotazione));
if($result){
    $rows=pg_fetch_all($result);
    
    for($i = 0; $i < count($rows); $i++){
        if($rows[$i]['utente']==$id_utente){
            echo json_encode(['success' => false, 'message' => 'Non puoi aggiungerti alla prenotazione in quanto ne fai già parte!']);
            exit();
        }
    }
    //I check that whoever wants to add to the booking does not already have a booking in that slot
    $check="SELECT * FROM prenotazione WHERE data='{$rows[0]['data']}' and ora_inizio='{$rows[0]['ora_inizio']}' and ora_fine='{$rows[0]['ora_fine']}' and utente='$id_utente'";
    $res= pg_query($conn, $check);
    $num_rows=pg_num_rows($res);
    if($num_rows>0){
        echo json_encode(['success' => false, 'message' => 'Hai già una prenotazione in questo slot']);
        exit();
    }
    // Increase the number of people
    $num_persone = $rows[0]['num_persone'] + 1;

    // Create the insert query
    $query = "INSERT INTO Prenotazione (id_prenotazione,campo,data,ora_inizio,ora_fine,utente,completa,sport,owner,num_persone) VALUES ('$id_prenotazione','{$rows[0]['campo']}','{$rows[0]['data']}','{$rows[0]['ora_inizio']}','{$rows[0]['ora_fine']}','$id_utente','";

    $sport=pg_escape_string($rows[0]['sport']);
    // Determines if the reservation is complete
    if ($num_persone == 10 && ($sport == 'calcetto' || $sport == 'basket')) {
        $query .= "true','$sport','false','10')";
        $queryUp ="UPDATE prenotazione SET num_persone = '10', completa=TRUE WHERE id_prenotazione=$id_prenotazione";
    } else if ($num_persone == 4 && $sport == 'paddle') {
        $query .= "true','$sport','false','4')";
        $queryUp ="UPDATE prenotazione SET num_persone = '4', completa= TRUE WHERE id_prenotazione=$id_prenotazione";
    } else if ($num_persone == 2 && $sport == 'tennis') {
        $query .= "true','$sport','false','2')";
        $queryUp ="UPDATE prenotazione SET num_persone = '2', completa= TRUE WHERE id_prenotazione=$id_prenotazione";
    } else {
        $query .= "false','$sport','false','$num_persone')";
        $queryUp ="UPDATE prenotazione SET num_persone = $num_persone WHERE id_prenotazione=$id_prenotazione";
    }

    // Run the insert query
    $insert_result = pg_query($conn, $query);
    $update_result = pg_query($conn, $queryUp);

    if ($insert_result) {
        echo json_encode(['success' => true, 'message' => 'Ti sei registrato con successo alla partita!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante l\'inserimento della prenotazione nel database.']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'errore: la query non è andata a buon fine']);
}
//Close the database connection
pg_close($conn);
?>