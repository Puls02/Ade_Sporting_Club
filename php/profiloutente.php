<?php
// Connessione al database (esempio utilizzando MySQLi)
$host='127.0.0.1';
$port='5432';
$dbname='Ade_Sporting_Club';
$user='postgres';
$password='eleonora'; //Sporting77!

$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verifica connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
} else {
    echo "Connessione stabilita\n";
}

// Email dell'utente da cercare
$user_email = "email@example.com"; // Cambia con l'email desiderata

// Query per ottenere i dati dell'utente in base all'email
$sql = "SELECT nome, cognome, data_di_nascita, tipo_abbonamento, data_sottoscrizione_abbonamento FROM utenti WHERE email = '$user_email'";
$result = $conn->query($sql);

// Se ci sono risultati dalla query
if ($result->num_rows > 0) {
    // Output dei dati dell'utente
    while($row = $result->fetch_assoc()) {
        $nome = $row["nome"];
        $cognome = $row["cognome"];
        $data_di_nascita = $row["data_di_nascita"];
        $tipo_abbonamento = $row["tipo_abbonamento"];
        $data_sottoscrizione_abbonamento = $row["data_sottoscrizione_abbonamento"];
    }
} else {
    echo "Nessun risultato trovato";
}
$conn->close();
?>

<!-- Stampare i dati nell'HTML -->
<div class="profile-details">
    <p><strong>Nome:</strong> <?php echo $nome; ?></p>
    <p><strong>Cognome:</strong> <?php echo $cognome; ?></p>
    <p><strong>Data di nascita:</strong> <?php echo $data_di_nascita; ?></p>
    <p><strong>Tipo di abbonamento:</strong> <?php echo $tipo_abbonamento; ?></p>
    <p><strong>Data sottoscrizione abbonamento:</strong> <?php echo $data_sottoscrizione_abbonamento; ?></p>
</div>
