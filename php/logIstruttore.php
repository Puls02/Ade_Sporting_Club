<?php
    session_start();

    $error = '';

    $host='127.0.0.1';
    $port='5432';
    $dbname='Ade_Sporting_Club';
    $user='postgres';
    $password='Sporting77!';

    $conn=pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    if(!$conn){
        die("Errore nella connessione a PostgreSQL");
    }

    $username = $_POST['codice'];
    $password = $_POST['password'];

    $query = "SELECT * FROM istruttore WHERE codice = '$username'";
    // printa il risultato di $query
    
    $result = pg_query($conn, $query);
    if ($result) {
        echo 'Query successful. Number of rows: ' . pg_num_rows($result);
    } else {
        echo 'Query failed: ' . pg_last_error($conn);
    }

    if ($result && pg_num_rows($result) === 1) {
        // Recupera l'istruttore
        $user = pg_fetch_assoc($result);
        echo $password;
        echo $user['password'];
        if ($password === $user['password']) {
            echo "Password corretta.sei dentro";
            // Imposta la sessione
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $user['nome'];
            $_SESSION['surname'] = $user['cognome'];
            $_SESSION['data_nascita'] = $user['data_nascita'];
            $_SESSION['mail'] = $user['email'];
            $_SESSION['phone'] = $user['telefono'];
            $_SESSION['id'] = $user['id'];
            $id=$user['id'];
            //setta lo stato dell'utente a true
            $query = "UPDATE istruttore SET status = TRUE WHERE id='$id'";

            // Reindirizza alla pagina successiva
            header("Location: ../login_registrazione/Istruttore.php");        
        } else {
            die("Password errata.");
        }
    } else {
        die("Utente non trovato.");
    }


    pg_close($conn);
?>