<?php
session_start();
include_once "../chat/php/config.php";

$outgoing_id = $_SESSION['username'];
$searchTerm = pg_escape_string($_POST['searchTerm']);

$sql = "SELECT * FROM Utente WHERE NOT unique_id = '{$outgoing_id}' AND (name LIKE '%{$searchTerm}%' OR surname LIKE '%{$searchTerm}%')";
$output = "";
$query = pg_query($conn, $sql);

if (pg_num_rows($query) > 0) {
    include_once "data.php";
} else {
    $output .= 'No user found related to your search term';
}
echo $output;
?>