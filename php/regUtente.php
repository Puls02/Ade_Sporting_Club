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

//dati utente
$nome= $_POST['nome'];
$cognome= $_POST['cognome'];
$sesso = $_POST['sesso'];
$residenza = $_POST['residenza'];
$luogo_nascita = $_POST['nascita'];
$data_nascita = $_POST['nata'];
$elementi = explode("-", $data_nascita); // Divide in [gg, mm, aaaa]
$elementiInvertiti = array_reverse($elementi); // Inverte l'ordine
$data_nascita = implode("-", $elementiInvertiti); //Ricompone la data
$email = $_POST['indirizzomail'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$telefono = $_POST['telefono'];
//inserimento utente

$query = "INSERT INTO Utente (nome, cognome, sesso, residenza, luogo_nascita, data_nascita, email, telefono, password) VALUES ('$nome','$cognome','$sesso','$residenza','$luogo_nascita','$data_nascita','$email','$telefono','$password')";
$result = pg_query($conn, $query);
if ($result) {
    echo "Utente registrato con successo!";
} else {
    echo "Errore durante la registrazione:"  . pg_last_error($conn);
}

//inserimento cliente
$doc1= $_POST['identity'];
$doc2= $_POST['certmed'];

$query = "INSERT INTO Cliente (doc_identita, certificato_med) VALUES ('$doc1','$doc2') RETURNING id";
$result = pg_query($conn, $query);
if ($result) {
    $row = pg_fetch_assoc($result);
    $cli_id = $row['id'];
    echo "Utente registrato con successo!";
} else {
    echo "Errore durante la registrazione Cliente:"  . pg_last_error($conn);
}

//dati abbonamento
$tipo_abbonamento=$_POST['type'];
$livello= $_POST['abbonamentospecifico'];
$sconto='false';

if($livello=='gold'){
    $sconto='true';
    $query = "INSERT INTO Cliente_Gold DEFAULT VALUES";
    $result = pg_query($conn, $query);
    if ($result) {
        echo "Utente registrato con successo!";
    } else {
        echo "Errore durante la registrazione Cliente:"  . pg_last_error($conn);
    }
}
$abb_cod="";
$query = "INSERT INTO Abbonamento (tipo, livello, sconto) VALUES ('$tipo_abbonamento','$livello', '$sconto') RETURNING Codice";
$result = pg_query($conn, $query);
if ($result) {
    $row = pg_fetch_assoc($result);
    $abb_cod = $row['codice'];
    echo "Abbonamento registrato con successo!";
} else {
    echo "Errore durante la registrazione Cliente:"  . pg_last_error($conn);
}

//inserisce sottoscrizione
$query = "INSERT INTO Sottoscrive (Cliente, Abbonamento) VALUES ('$cli_id','$abb_cod')";
$result = pg_query($conn, $query);
if ($result) {
    echo "Sottoscrizione effettuata con successo!";
} else {
    echo "Errore durante la registrazione:"  . pg_last_error($conn);
}

if($sconto=='true'){
    $query = "INSERT INTO Sottoscrizione_gold (Cliente, Abbonamento) VALUES ('$cli_id','$abb_cod')";
    $result = pg_query($conn, $query);
    if ($result) {
        echo "Sottoscrizione effettuata con successo!";
    } else {
        echo "Errore durante la registrazione:"  . pg_last_error($conn);
    }
}

//dati corso
if($livello=='single' || $livello=='gym'){
    $corso= implode($_POST['corso']);
    $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso','$abb_cod')";
    $result = pg_query($conn, $query);
    if ($result) {
        echo "Sottoscrizione effettuata con successo!";
    } else {
        echo "Errore durante la registrazione:"  . pg_last_error($conn);
    }
} else {
    $corso= $_POST['corso'];
    $corso1=$corso[0];
    $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso1','$abb_cod')";
    $result = pg_query($conn, $query);
    if ($result) {
        echo "Sottoscrizione effettuata con successo!";
    } else {
        echo "Errore durante la registrazione:"  . pg_last_error($conn);
    }
    $corso2=$corso[1];
    $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso2','$abb_cod')";
    $result = pg_query($conn, $query);
    if ($result) {
        echo "Sottoscrizione effettuata con successo!";
    } else {
        echo "Errore durante la registrazione:"  . pg_last_error($conn);
    }
}


pg_close($conn);


?>


