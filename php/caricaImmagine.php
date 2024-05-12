<?php
   session_start();
   //connessione
   $host='127.0.0.1';
   $port='5432';
   $dbname='Ade_Sporting_Club';
   $user='postgres';
   $password='Sporting77!';
   
   $conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
   
   if(!$conn){
       die("Errore nella connessione a PostgreSQL");
   }
   
   // Leggi il file temporaneo dell'immagine
   $imageTmpName = $_FILES['fotoprof']['tmp_name'];
   
   // Verifica se il percorso del file temporaneo dell'immagine è valido
   if (!$imageTmpName) {
       die("Percorso del file temporaneo dell'immagine non valido");
   }
   
   // Leggi il contenuto del file come stringa
   $foto = file_get_contents($imageTmpName);
   
   // Escapare il contenuto dell'immagine per evitare SQL injection
   $fotoEscaped = pg_escape_bytea($conn, $foto);
   
   $id=$_SESSION['id'];
   
   $query="UPDATE Utente SET Foto_profilo = '$fotoEscaped' WHERE id='$id'";
   $result = pg_query($conn, $query);
   
   if(!$result){
       die("Errore nell'inserimento della foto profilo");
   }

?>