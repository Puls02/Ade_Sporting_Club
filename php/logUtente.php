<?php
    session_start();

    $error = '';

    include_once "config.php";

    $username = $_POST['indirizzomail'];
    $password = $_POST['password'];

    $query = "SELECT * FROM utente WHERE email = '$username'";
    $result = pg_query($conn, $query);

    if ($result && pg_num_rows($result) === 1) {
        // Recover the user
        $user = pg_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
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
            $_SESSION['abb']='prenotazione';
            // sets the user's status to true
            $query = "UPDATE utente SET status = TRUE WHERE id='$id'";
            $result = pg_query($conn, $query);
            if($user['corsi']=='t'){
                // sets the session variables for the subscription
                $_SESSION['abb']='corso';
                $query = "SELECT * FROM sottoscrizione WHERE cliente = '$id'";
                $result = pg_query($conn, $query);
                $sottoscrizione=pg_fetch_assoc($result);
                $codice=$sottoscrizione['abbonamento'];
            
                $query = "SELECT * FROM abbonamento WHERE codice = '$codice'";
                $result = pg_query($conn, $query);
                $abbonamento=pg_fetch_assoc($result);
                $_SESSION['livello'] = $abbonamento['livello'];
                $query= "SELECT * FROM Cliente_Gold WHERE id='$id'";
                $result = pg_query($conn, $query);
                if(pg_num_rows($result) === 1 && $result){
                    $_SESSION['gold']=true;
                    header("Location: ../login_registrazione/utenteGold.php");
                    exit();
                }
            }
            // Redirect to the next page
            header("Location: ../login_registrazione/utenteNonGold.php");
            exit();
            
        } else {
            $_SESSION['credenziali'] = "Password errata";
            pg_close($conn);
            header("Location: {$_SESSION['url']}");
            exit();
        }
    } else {
        $_SESSION['credenziali'] = "Utente non trovato";
        pg_close($conn);
        header("Location: {$_SESSION['url']}");
        exit();
    }


    pg_close($conn);
?>