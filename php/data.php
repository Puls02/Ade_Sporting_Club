<?php
while ($row = pg_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messaggi WHERE (incoming_msg_id = '{$row['id']}'
            OR outgoing_msg_id = '{$row['id']}') AND (outgoing_msg_id = '{$outgoing_id}' 
            OR incoming_msg_id = '{$outgoing_id}') ORDER BY msg_id DESC LIMIT 1";
    $query2 = pg_query($conn, $sql2);
    $row2 = pg_fetch_assoc($query2);
    (pg_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "Nessun messaggio disponibile";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    
    // Controllo sull'immagine del profilo
    $foto_profilo = (isset($row['Foto_profilo']) && $row['Foto_profilo'] !== null) ? '../immagini/galleria'.$row['Foto_profilo'] : '../immagini/photo-camera.png';
    
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "Tu: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['id']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="../chat.php?user_id='. $row['id'] .'">
                <div class="content">
                <img src="php/images/'. $foto_profilo .'" alt="">
                <div class="details">
                    <span>'. $row['nome']. " " . $row['cognome'] .'</span>
                    <p>'. $you . $msg .'</p>
                </div>
                </div>
                <div class="status-dot '. $offline .'"><i class="fas fa-circle"></i></div>
            </a>';
}
?>
