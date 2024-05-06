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

    $username = $_POST['indirizzomail'];
    $password = $_POST['password'];

    $query = "SELECT * FROM utente WHERE email = '$username'";
    $result = pg_query($conn, $query);

    if ($result && pg_num_rows($result) === 1) {
        // Recupera l'utente
        $user = pg_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            // Imposta la sessione
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            $id=$user['id'];

            $query= "SELECT * FROM Cliente_Gold WHERE id='$id'";
            $result = pg_query($conn, $query);
            // Reindirizza alla pagina successiva
            if(pg_num_rows($result) === 1 && $result){
                header("Location: ../login_registrazione/utenteGold.php");
                exit;
            }else{
                header("Location: ../login_registrazione/utenteNonGold.php");
                exit;
            }
            
            
        } else {
            die("Password errata.");
        }
    } else {
        die("Utente non trovato.");
    }


    pg_close($conn);
?>