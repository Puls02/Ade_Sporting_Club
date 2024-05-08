<?php
session_start();
include_once "../chat/php/config.php";
$outgoing_id = $_SESSION['username'];
$sql = "SELECT ID FROM Utente WHERE NOT email = '{$outgoing_id}'";
$query = pg_query($conn, $sql);
$output = "";
if (pg_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (pg_num_rows($query) > 0) {
    include_once "data.php";
}
echo $output;
?>
