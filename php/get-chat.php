<?php 
    session_start();
    if (isset($_SESSION['id'])) {
        include_once "config.php";
        $outgoing_id = $_SESSION['id'];
        $incoming_id = pg_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM messaggi LEFT JOIN Utente ON utente.id = messaggi.outgoing_msg_id
                WHERE (outgoing_msg_id = '{$outgoing_id}' AND incoming_msg_id = '{$incoming_id}')
                OR (outgoing_msg_id = '{$incoming_id}' AND incoming_msg_id = '{$outgoing_id}') ORDER BY msg_id";
        $query = pg_query($conn, $sql);
        if (pg_num_rows($query) > 0) {
            while ($row = pg_fetch_assoc($query)) {
                if ($row['outgoing_msg_id'] === $outgoing_id) {
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        } else {
            $output .= '<div class="text">Nessun messaggio disponibile. Una volta inviato un messaggio apparirà qui.</div>';
        }
        echo $output ;
    } else {
        header("location: ../login.php");
    }
?>
