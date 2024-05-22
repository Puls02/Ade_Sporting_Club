<?php
    session_start();

    $error = '';

    include_once "config.php";

    $username = $_POST['indirizzomail'];
    $password = $_POST['password'];
    //$remember_me = isset($_POST['remember_me']); 

    $query = "SELECT * FROM utente WHERE email = '$username'";
    $result = pg_query($conn, $query);

    if ($result && pg_num_rows($result) === 1) {
        // Recupera l'utente
        $user = pg_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
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
            $_SESSION['abb']='prenotazione';
            //setta lo stato dell'utente a true
            $query = "UPDATE utente SET status = TRUE WHERE id='$id'";
            $result = pg_query($conn, $query);
            if($user['corsi']=='t'){
                //imposto le variabili di sessione per l'abbonamento
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
            
            
            // Imposta il cookie se "Ricordami" è selezionato
            //if ($remember_me) {
                //setcookie('remember_me', $user['id'], time() + (86400 * 30), "/", "", true, true); // cookie valido per 30 giorni
            //}

            // Reindirizza alla pagina successiva
            
            header("Location: ../login_registrazione/utenteNonGold.php");
            exit();
            
        } else {
            die("Password errata.");
        }
    } else {
        die("Utente non trovato.");
    }


    pg_close($conn);
?>