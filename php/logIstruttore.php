<?php
    session_start();

    $error = '';

    include_once "config.php";

    $username = $_POST['codice'];
    $password = $_POST['password'];

    $query = "SELECT * FROM istruttore WHERE codice = '$username'";
    
    $result = pg_query($conn, $query);
    if ($result) {
        echo 'Query successful. Number of rows: ' . pg_num_rows($result);
    } else {
        echo 'Query failed: ' . pg_last_error($conn);
    }

    if ($result && pg_num_rows($result) === 1) {
        //Retrieve the instructor
        $user = pg_fetch_assoc($result);
        echo $password;
        echo $user['password'];
        if ($password === $user['password']) {
            echo "Password corretta.sei dentro";
            //Set up the session
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user['nome'];
            $_SESSION['surname'] = $user['cognome'];
            $_SESSION['data_nascita'] = $user['data_nascita'];
            $_SESSION['mail'] = $user['email'];
            $_SESSION['phone'] = $user['telefono'];
            $_SESSION['id'] = $user['id'];
            $id=$user['id'];
            //set the user's status to true
            $query = "UPDATE istruttore SET status = TRUE WHERE id='$id'";
            $result = pg_query($conn, $query);

            //Redirect to the next page
            header("Location: ../login_registrazione/Istruttore.php");        
        } else {
            die("Password errata.");
        }
    } else {
        die("Utente non trovato.");
    }


    pg_close($conn);
?>