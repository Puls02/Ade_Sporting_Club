<?php
// Connect to the database
include_once "config.php";

// Get the form data
$titolo = pg_escape_string($_POST['titolo']);
$giorno = $_POST['giorno'];
$orario_inizio = $_POST['orario_inizio'];
$descrizione = pg_escape_string($_POST['descrizione']);
// pg_escape_string permette i caratteri speciali nella stringa

// Prepare the SQL query
$query = "INSERT INTO evento (titolo, giorno, orario_inizio, descrizione) VALUES ('$titolo', '$giorno', '$orario_inizio', '$descrizione')";

// Execute the query
$result = pg_query($conn,$query) or die('Query failed: ' . pg_last_error());

// Redirect back to the original page or display a success message
header('Location: ../login_registrazione/Istruttore.php');
exit;

// Close connection
pg_close($conn);
?>