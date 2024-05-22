<?php
  $host='127.0.0.1';
  $port='5432';
  $dbname='Ade_Sporting_Club';
  $user='postgres';
<<<<<<< HEAD
  $password='davidino';

=======
  $password='Sporting77!';
>>>>>>> ce53b812d409bc553f54932537982ffc39395c1c
  
  $conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
  
  if(!$conn){
      die("Errore nella connessione a PostgreSQL");
  } 
  
?>