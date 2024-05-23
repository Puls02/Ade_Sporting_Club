<?php 
session_start();
include_once "config.php";

$username=$_POST['email'];

$query="SELECT + FROM utente WHERE email=$username";
$result=pg_query($conn,$query);

if(pg_num_rows($result)>0){
    echo json_encode(['success' => false]);
}


?>