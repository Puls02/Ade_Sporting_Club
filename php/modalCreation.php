<?php
    //to open the window that allows you to modify a reservation
    include_once "config.php";

    $id = $_POST['id'];
    $result = pg_query($conn, "SELECT * FROM prenotazione WHERE id_prenotazione = $id and owner='true'");
    if ($result) {
        $row = pg_fetch_assoc($result);
        echo json_encode([
            'id' => $row['id_prenotazione'],
            'sport' => $row['sport'],
            'campo' => $row['campo'],
            'num_persone' => $row['num_persone']
        ]);
    }

    pg_close($conn);
?>
