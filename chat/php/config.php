<?php
  $hostname = "127.0.0.1";
  $port = '5432';
  $username = "postgres";
  $password = "eleonora";
  $dbname = "Ade_Sporting_Club";

  $conn=pg_connect("host=$hostname port=$port dbname=$dbname user=$username password=$password");

  if(!$conn){
      die("Errore nella connessione a PostgreSQL");
  } else {
      echo "Connessione stabilita\n";
  }
?>
