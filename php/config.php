<?php
  $host='127.0.0.1';
  $port='5432';
  $dbname='Ade_Sporting_Club';
  $user='postgres';
  $password='Sportintg77!';
  
  $conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
  
  if(!$conn){
      die("Errore nella connessione a PostgreSQL");
  } 
  
?>