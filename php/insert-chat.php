<?php 
session_start();
if (isset($_SESSION['id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['id'];
    $incoming_id = pg_escape_string($conn, $_POST['incoming_id']);
    $message = pg_escape_string($conn, $_POST['message']);
    if (!empty($message)) {
        $sql = pg_query($conn, "INSERT INTO messaggi (incoming_msg_id, outgoing_msg_id, msg)
                                VALUES ('{$incoming_id}', '{$outgoing_id}', '{$message}')");
    }
} else {
    header("location: ../login.php");
}
?>
