<?php


$host='127.0.0.1';
$port='5432';
$dbname='elegrandissima';
$user='postgres';
$password='Sporting77!';

$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if(!$conn){
    die("Errore nella connessione a PostgreSQL");
} else {
    echo "Connssione stabilita";
}

$nome= $_POST['nome'];
$cognome= $_POST['cognome'];

$query= "INSERT INTO Gay (nome, cognome) VALUES ('$nome','$cognome')";

$result = pg_query($conn, $query);

if ($result) {
    echo "Utente registrato con successo!";
} else {
    echo "Errore durante la registrazione:"  . pg_last_error($conn);
}

/*
$sesso = $_POST['sesso'];
$residenza = $_POST['residenza'];
$luogo_nascita = $_POST['nascita'];
$giorno_nascita = $_POST['nata'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$telefono = $_POST['telefono'];
$tipo_abbonamento=$_POST['type'];
$livello= $_POST['abbonamentospecifico'];
$doc1= $_POST['identity'];
$doc2= $_POST['certmed'];

if($livello=='single' || $livello=='gym'){
    $corso= $_POST['corso'];
} else {
    $corsi= $_POST['corso'];
    $corso1=$corsi[0];
    $corso2=$corsi[1];
}

/*$query = "INSERT INTO Utente (nome, cognome, sesso, residenza, luogo_nascita, data_nascita, email, telefono, password) VALUES ('$nome','$cognome','$sesso','$residenza','$luogo_nascita','$data_nascita','$email','$telefono','$password')";

$result = pg_query($conn, $query);

if ($result) {
    echo "Utente registrato con successo!";
} else {
    echo "Errore durante la registrazione:"  . pg_last_error($conn);
}
*/

pg_close($conn);


?>

