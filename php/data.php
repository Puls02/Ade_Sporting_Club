<?php
    //Array to store parts of the output
    $online_users = [];
    $offline_users_messages = [];
    $offline_users = [];

    while ($row = pg_fetch_assoc($query)) {
        $sql2 = "SELECT * FROM messaggi WHERE (incoming_msg_id = '{$row['id']}'
                OR outgoing_msg_id = '{$row['id']}') AND (outgoing_msg_id = '{$outgoing_id}' 
                OR incoming_msg_id = '{$outgoing_id}') ORDER BY msg_id DESC LIMIT 1";
        $query2 = pg_query($conn, $sql2);
        $row2 = pg_fetch_assoc($query2);
        $result = (pg_num_rows($query2) > 0) ? $row2['msg'] : "Nessun messaggio disponibile";
        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

        //Control over your profile picture
        $foto_profilo_bytea = $row['foto_profilo'];
        if ($foto_profilo_bytea !== null) {
            //Decodes bytea data
            $foto_decodata = pg_unescape_bytea($foto_profilo_bytea);
            $foto_profilo = 'data:image/jpeg;base64,' . base64_encode($foto_decodata);
        } else {
            $foto_profilo = '../immagini/photo-camera.png';
        }

        $you = (isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id']) ? "Tu: " : "";
        $classe = ($row['status'] === 'f') ? "status-dot-offline" : "status-dot";
        $hid_me = ($outgoing_id == $row['id']) ? "hide" : "";

        $user_output = '<a href="../chat.php?user_id='. $row['id'] .'" target="chatframe" class="chat-link">
                        <div class="content">
                        <img src="'. $foto_profilo .'" alt="Foto Profilo">
                        <div class="details">
                            <span>'. $row['nome']. " " . $row['cognome'] .'</span>
                            <p>'. $you . $msg .'</p>
                        </div>
                        </div>
                        <div class="'.$classe.'"><i class="fas fa-circle"></i></div>
                    </a>';

        //Add the output to the appropriate list
        if ($row['status'] === 't') {
            $online_users[] = $user_output;
        } else if ($result !== "Nessun messaggio disponibile") {
            $offline_users_messages[] = $user_output;
        } else {
            $offline_users[] = $user_output;
        }
    }

    //In order in the conversation we will find the online users, the users with whom we have exchanged messages and finally the other available users
    $output = implode('', array_merge($online_users, $offline_users_messages, $offline_users));
?>
