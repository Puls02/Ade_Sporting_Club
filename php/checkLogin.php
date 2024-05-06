<?php
    echo "duifhsriughskurhbgksurbfskbfjksbk";
   session_start(); // Avvia la sessione
    
   // Verifica se l'utente è loggato
   if (isset($_SESSION['username'])) {
       // Se loggato, risponde "logged_in"
       echo "logged_in";
   } else {
       // Se non loggato, risponde "not_logged_in"
       echo "not_logged_in";
   }
?>