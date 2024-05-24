<?php
    session_start();
    include_once "config.php";

    $id=$_SESSION['id'];

    //Update the status of the instructor or user
    if ($id < 30) {
        $query = "UPDATE istruttore SET status = FALSE WHERE id='$id'";
    } else {
        $query = "UPDATE utente SET status = FALSE WHERE id='$id'";
    }
    $result = pg_query($conn, $query);

    session_unset(); //Clears all session variables
    session_destroy(); //Destroys the session

    header("Location: ../index.php"); //Redirects to the home page
    exit();
    
?>
