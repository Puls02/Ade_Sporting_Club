<?php

function checkMail($conn,$email){
    $query = "SELECT * FROM utente where email='$email'";
    $result = pg_query($conn, $query);
    if (pg_num_rows($result) > 0) {
        return 1;
    }
}

function checkTel($conn,$telefono){
    $query = "SELECT * FROM utente where telefono='$telefono'";
    $result = pg_query($conn, $query);
    if (pg_num_rows($result) > 0) {
        return 1;
    }
}

$host='127.0.0.1';
$port='5432';
$dbname='Ade_Sporting_Club';
$user='postgres';
$password='eleonora';

$conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if(!$conn){
    die("Errore nella connessione a PostgreSQL");
} else {
    echo "Connessione stabilita\n";
}
//inizio transazione
pg_query($conn, "BEGIN");
//dati utente
$nome= $_POST['nome'];
$nome_escape=pg_escape_literal($conn,$nome);
$cognome= $_POST['cognome'];
$cognome_escape=pg_escape_literal($conn,$cognome);
$sesso = $_POST['sesso'];
$residenza = $_POST['residenza'];
$residenza_escape=pg_escape_literal($conn,$residenza);
$luogo_nascita = $_POST['nascita'];
$luogo_nascita_escape=pg_escape_literal($conn,$luogo_nascita);
$data_nascita = $_POST['nata'];
$email = $_POST['indirizzomail'];
if(checkMail($conn,$email)){
    die("L'email esiste già nel database.");
}
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$telefono = $_POST['telefono'];
if(checkTel($conn,$telefono)){
    die("Il numero di telefono esiste già nel database.");
}
//inserimento utente
$query = "INSERT INTO Utente (nome, cognome, sesso, residenza, luogo_nascita, data_nascita, email, telefono, password) VALUES ($nome_escape,$cognome_escape, '$sesso', $residenza_escape, $luogo_nascita_escape, '$data_nascita', '$email', '$telefono', '$password')";
$result = pg_query($conn, $query);
if (!$result) {
    //annulla la transazine se si verifica qualche errore
    pg_query($conn, "ROLLBACK");
    die("Errore nella registrazione Utente!" . pg_last_error($conn));
}

//inserimento cliente
$doc1= $_POST['identity'];
$doc2= $_POST['certmed'];

$query = "INSERT INTO Cliente (doc_identita, certificato_med) VALUES ('$doc1','$doc2') RETURNING id";
$result = pg_query($conn, $query);
if ($result) {
    $row = pg_fetch_assoc($result);
    $cli_id = $row['id'];
} else {
    pg_query($conn, "ROLLBACK");
    die("Errore durante la registrazione Cliente:"  . pg_last_error($conn));
}

//dati abbonamento
$tipo_abbonamento=$_POST['type'];
$livello= $_POST['abbonamentospecifico'];
$sconto='false';

if($livello=='gold'){
    $sconto='true';
    $query = "INSERT INTO Cliente_Gold (id) VALUES ('$cli_id')";
    $result = pg_query($conn, $query);
    if (!$result) {
        pg_query($conn, "ROLLBACK");
        die("Errore durante la registrazione Cliente_gold:"  . pg_last_error($conn));
    }
}
$abb_cod="";
$query = "INSERT INTO Abbonamento (tipo, livello, sconto) VALUES ('$tipo_abbonamento','$livello', '$sconto') RETURNING Codice";
$result = pg_query($conn, $query);
if ($result) {
    $row = pg_fetch_assoc($result);
    $abb_cod = $row['codice'];
} else {
    pg_query($conn, "ROLLBACK");
    die("Errore durante la registrazione dell'abbonamento:"  . pg_last_error($conn));
}

//inserisce sottoscrizione
$query = "INSERT INTO Sottoscrizione (Cliente, Abbonamento) VALUES ('$cli_id','$abb_cod')";
$result = pg_query($conn, $query);
if (!$result) {
    pg_query($conn, "ROLLBACK");
    die("Errore durante la sottoscrizione:"  . pg_last_error($conn));
}

if($sconto=='true'){
    $query = "INSERT INTO Sottoscrizione_Gold (Cliente, Abbonamento) VALUES ('$cli_id','$abb_cod')";
    $result = pg_query($conn, $query);
    if (!$result) {
        pg_query($conn, "ROLLBACK");
        die("Errore durante la sottoscrizione_gold:"  . pg_last_error($conn));
    }
}

//dati corso
if($livello=='single' || $livello=='gym'){
    $corso= implode($_POST['corso']);
    $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso','$abb_cod')";
    $result = pg_query($conn, $query);
    if (!$result) {
        pg_query($conn, "ROLLBACK");
        die("Errore durante la registrazione del corso:"  . pg_last_error($conn));
    }
    
} else {
    $corso= $_POST['corso'];
    $corso1=$corso[0];
    $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso1','$abb_cod')";
    $result = pg_query($conn, $query);
    if (!$result) {
        pg_query($conn, "ROLLBACK");
        die("Errore durante la registrazione dei corsi:"  . pg_last_error($conn));
    } 
    $corso2=$corso[1];
    $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso2','$abb_cod')";
    $result = pg_query($conn, $query);
    if (!$result) {
        pg_query($conn, "ROLLBACK");
        die("Errore durante la registrazione dei corsi:"  . pg_last_error($conn));
    } 
}
//conferma la transazione se tutto è andato a buon fine
pg_query($conn, "COMMIT");

echo "Utente registrato con sucesso";

pg_close($conn);

?>
