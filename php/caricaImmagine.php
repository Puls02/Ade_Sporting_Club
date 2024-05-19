<?php
   session_start();
   //connessione
   include_once "config.php";
   
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
   
   // ID dell'utente
   $id = $_SESSION['id'];
   
   // Recupera l'immagine esistente, se presente
   $query = "SELECT Foto_profilo FROM Utente WHERE id='$id'";
   $result = pg_query($conn, $query);
   
   // Controlla se la query ha avuto successo e se ci sono righe restituite
   if ($result && pg_num_rows($result) > 0) {
       // Estrai il risultato come un array associativo
       $row = pg_fetch_assoc($result);
       // Verifica se la chiave "Foto_profilo" è presente nell'array associativo
       if (array_key_exists('Foto_profilo', $row)) {
           // Se la chiave è presente, ottieni l'immagine esistente
           $immagineEsistente = $row['Foto_profilo'];
           // Elimina l'immagine esistente
           $queryDelete = "UPDATE Utente SET Foto_profilo = NULL WHERE id='$id'";
           $resultDelete = pg_query($conn, $queryDelete);
           if (!$resultDelete) {
               die("Errore nell'eliminazione dell'immagine esistente");
           }
       }
   }
   
   // Inserisci la nuova immagine
   $queryInsert = "UPDATE Utente SET Foto_profilo = '$fotoEscaped' WHERE id='$id'";
   $resultInsert = pg_query($conn, $queryInsert);
   if (!$resultInsert) {
       // In caso di errore, ripristina l'immagine precedente
       if (isset($immagineEsistente)) {
           $queryRestore = "UPDATE Utente SET Foto_profilo = '$immagineEsistente' WHERE id='$id'";
           $resultRestore = pg_query($conn, $queryRestore);
           if (!$resultRestore) {
               die("Errore nel ripristino dell'immagine precedente");
           }
       }
       die("Errore nell'inserimento della foto profilo");
   }
   
   // Se siamo arrivati qui, tutto è andato bene
   $query= "SELECT * FROM Cliente_Gold WHERE id='$id'";
    $result = pg_query($conn, $query);

    // Reindirizza alla pagina successiva
    if(pg_num_rows($result) === 1 && $result){
        header("Location: ../login_registrazione/utenteGold.php");
        exit;
    }else{
        header("Location: ../login_registrazione/utenteNonGold.php");
        exit;
    }
   
?>   