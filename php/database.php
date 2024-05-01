<?php

$host='127.0.0.1';
$port='5432';
$dbname='Ade_Sporting_CLub';
$user='postgres';
$password='Sporting77!';

$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if(!$conn){
    die("Errore nella connessione a PostgreSQL");
} else {
    echo "Connssione stabilita\n";
}



$nome= $_POST['nome'];
$cognome= $_POST['cognome'];
$sesso = $_POST['sesso'];
$residenza = $_POST['residenza'];
$luogo_nascita = $_POST['nascita'];
$giorno_nascita = $_POST['nata'];
$elementi = explode("-", $giorno_nascita); // Divide in [gg, mm, aaaa]
$elementiInvertiti = array_reverse($elementi); // Inverte l'ordine
$giorno_nascita = implode("-", $elementiInvertiti); //Ricompone la data
$email = $_POST['indirizzomail'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$telefono = $_POST['telefono'];
$tipo_abbonamento=$_POST['type'];
$livello= $_POST['abbonamentospecifico'];
$doc1= $_POST['identity'];
$doc2= $_POST['certmed'];



if($livello=='single' || $livello=='gym'){
    $corso= $_POST['corso'];
    echo implode($corso);
} else {
    $corso= $_POST['corso'];
    $corso1=$corso[0];
    echo $corso1;
    $corso2=$corso[1];
    echo $corso2;
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


