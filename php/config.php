<?php
  $host='127.0.0.1';
  $port='5432';
  $dbname='Ade_Sporting_Club';
  $user='postgres';
<<<<<<< HEAD
  $password='davidino';
=======
  $password='Sporting77!';
>>>>>>> 1df5d693a46b5ebf815f514d06abf4d716f7108b
  
  $conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
  
  if(!$conn){
      die("Errore nella connessione a PostgreSQL");
  } 
  
?>