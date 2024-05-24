<?php
   session_start();

   include_once "config.php";
   
   // Read the temporary image file
   $imageTmpName = $_FILES['fotoprof']['tmp_name'];
   
   //Check if the image temporary file path is valid
   if (!$imageTmpName) {
       die("Percorso del file temporaneo dell'immagine non valido");
   }
   
   // Read the contents of the file as a string
   $foto = file_get_contents($imageTmpName);
   
   // Escape image content to avoid SQL injection
   $fotoEscaped = pg_escape_bytea($conn, $foto);
   
   // User ID
   $id = $_SESSION['id'];

    // recovers the existing image, if any
   if ($id < 30) {
        $query = "SELECT Foto_profilo FROM Istruttore WHERE id='$id'";
   } else {
        $query = "SELECT Foto_profilo FROM Utente WHERE id='$id'";
   }
   
   $result = pg_query($conn, $query);
   
   // Check if the query was successful and if there are rows returned
   if ($result && pg_num_rows($result) > 0) {
       //Extract the result as an associative array
       $row = pg_fetch_assoc($result);
       //Check if the "Profile_Photo" key is present in the associative array
       if (array_key_exists('Foto_profilo', $row)) {
           // If the key is present, you get the existing image
           $immagineEsistente = $row['Foto_profilo'];
           // Delete the existing image
           if ($id < 30) {
                $queryDelete = "UPDATE Istruttore SET Foto_profilo = NULL WHERE id='$id'";
            } else {
                $queryDelete = "UPDATE Utente SET Foto_profilo = NULL WHERE id='$id'";
            }
           $resultDelete = pg_query($conn, $queryDelete);
           if (!$resultDelete) {
               die("Errore nell'eliminazione dell'immagine esistente");
           }
       }
   }
   
   // Insert the new image
   if ($id < 30) {
        $queryInsert = "UPDATE Istruttore SET Foto_profilo = '$fotoEscaped' WHERE id='$id'";
    } else {
        $queryInsert = "UPDATE Utente SET Foto_profilo = '$fotoEscaped' WHERE id='$id'";
    }
   $resultInsert = pg_query($conn, $queryInsert);
   if (!$resultInsert) {
       // In case of error, restore the previous image
       if (isset($immagineEsistente)) {
            if ($id < 30) {
                $queryRestore = "UPDATE Istruttore SET Foto_profilo = '$immagineEsistente' WHERE id='$id'";
            } else {
                $queryRestore = "UPDATE Utente SET Foto_profilo = '$immagineEsistente' WHERE id='$id'";
            }            
           $resultRestore = pg_query($conn, $queryRestore);
           if (!$resultRestore) {
               die("Errore nel ripristino dell'immagine precedente");
           }
       }
       die("Errore nell'inserimento della foto profilo");
   }
   
   if ($id < 30) {
        $query= "SELECT * FROM Istruttore WHERE id='$id'";
        $result = pg_query($conn, $query);

        if(pg_num_rows($result) === 1 && $result){
            header("Location: ../login_registrazione/Istruttore.php");
            exit;
        }else{
            exit;
        }

   } else {
        $query= "SELECT * FROM Cliente_Gold WHERE id='$id'";
        $result = pg_query($conn, $query);

        // Redirect to the next page
        if(pg_num_rows($result) === 1 && $result){
            header("Location: ../login_registrazione/utenteGold.php");
            exit;
        }else{
            header("Location: ../login_registrazione/utenteNonGold.php");
            exit;
        }
   }   
?>   