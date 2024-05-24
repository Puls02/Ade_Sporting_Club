<?php
    session_start();
    function checkMail($conn,$email){
        $query = "SELECT * FROM utente where email='$email'";
        $result = pg_query($conn, $query);
        if (pg_num_rows($result) > 0) {
            return 1;
        }
    }

    function checkTel($conn,$telefono){
        $query = "SELECT * FROM utente where telefono='$telefono'";
        $result = pg_query($conn, $query);
        if (pg_num_rows($result) > 0) {
            return 1;
        }
    }

    include_once "config.php";

    //start of transaction
    pg_query($conn, "BEGIN");
    //User data
    $nome= $_POST['nome'];
    $nome_escape=pg_escape_literal($conn,$nome);
    $cognome= $_POST['cognome'];
    $cognome_escape=pg_escape_literal($conn,$cognome);
    $sesso = $_POST['sesso'];
    $residenza = $_POST['residenza'];
    $residenza_escape=pg_escape_literal($conn,$residenza);
    $luogo_nascita = $_POST['nascita'];
    $luogo_nascita_escape=pg_escape_literal($conn,$luogo_nascita);
    $data_nascita = $_POST['nata'];
    $email = $_POST['indirizzomail'];
    if(checkMail($conn,$email)){
        $_SESSION['message']="Questo indirizzo email è già registrato. Si prega di utilizzare un altro indirizzo email.";
        header("Location: ../login_registrazione/registration.php");
        exit;
    }
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $telefono = $_POST['telefono'];
    if(checkTel($conn,$telefono)){
        $_SESSION['message']="Questo numero di telefono è già registrato. Si prega di utilizzare un altro numero.";
        header("Location: ../login_registrazione/registration.php");
        exit;
    }

    $corsi=$_POST['corso_campo'];

    if($corsi=='corso'){
        //user entry
        $query = "INSERT INTO Utente (nome, cognome, sesso, residenza, luogo_nascita, data_nascita, email, telefono, password,corsi) VALUES ($nome_escape,$cognome_escape, '$sesso', $residenza_escape, $luogo_nascita_escape, '$data_nascita', '$email', '$telefono', '$password','true')";
        $result = pg_query($conn, $query);
        if (!$result) {
            //cancel the transaction if any error occurs
            pg_query($conn, "ROLLBACK");
            die("Errore nella registrazione Utente!" . pg_last_error($conn));
        }
    } else if($corsi=='campo'){
        //user entry
        $query = "INSERT INTO Utente (nome, cognome, sesso, residenza, luogo_nascita, data_nascita, email, telefono, password,corsi) VALUES ($nome_escape,$cognome_escape, '$sesso', $residenza_escape, $luogo_nascita_escape, '$data_nascita', '$email', '$telefono', '$password','false')";
        $result = pg_query($conn, $query);
        if (!$result) {
            //cancel the transaction if any error occurs
            pg_query($conn, "ROLLBACK");
            die("Errore nella registrazione Utente!" . pg_last_error($conn));
        }
    }


    //customer entry
    $doc1= $_POST['identity'];
    $doc2= $_POST['certmed'];

    $query = "INSERT INTO Cliente (doc_identita, certificato_med) VALUES ('$doc1','$doc2') RETURNING id";
    $result = pg_query($conn, $query);
    if ($result) {
        $row = pg_fetch_assoc($result);
        $cli_id = $row['id'];
    } else {
        pg_query($conn, "ROLLBACK");
        die("Errore durante la registrazione Cliente:"  . pg_last_error($conn));
    }

    if($corsi=='corso'){
        //subscription data
        $tipo_abbonamento=$_POST['type'];
        $livello= $_POST['abbonamentospecifico'];
        $sconto='false';
        $categoria=$_POST['categoria'];

        if($livello=='gold'){
            $sconto='true';
            $query = "INSERT INTO Cliente_Gold (id) VALUES ('$cli_id')";
            $result = pg_query($conn, $query);
            if (!$result) {
                pg_query($conn, "ROLLBACK");
                die("Errore durante la registrazione Cliente_gold:"  . pg_last_error($conn));
            }
        }
        $abb_cod="";
        $query = "INSERT INTO Abbonamento (tipo, livello, sconto, categoria) VALUES ('$tipo_abbonamento','$livello', '$sconto','$categoria') RETURNING Codice";
        $result = pg_query($conn, $query);
        if ($result) {
            $row = pg_fetch_assoc($result);
            $abb_cod = $row['codice'];
        } else {
            pg_query($conn, "ROLLBACK");
            die("Errore durante la registrazione dell'abbonamento:"  . pg_last_error($conn));
        }

        //inserts subscription
        $query = "INSERT INTO Sottoscrizione (Cliente, Abbonamento) VALUES ('$cli_id','$abb_cod')";
        $result = pg_query($conn, $query);
        if (!$result) {
            pg_query($conn, "ROLLBACK");
            die("Errore durante la sottoscrizione:"  . pg_last_error($conn));
        }

        if($sconto=='true'){
            $query = "INSERT INTO Sottoscrizione_Gold (Cliente, Abbonamento) VALUES ('$cli_id','$abb_cod')";
            $result = pg_query($conn, $query);
            if (!$result) {
                pg_query($conn, "ROLLBACK");
                die("Errore durante la sottoscrizione_gold:"  . pg_last_error($conn));
            }
        }

        //course data
        if($livello=='single' || $livello=='gym'){
            $corso= implode($_POST['corso']);
            $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso','$abb_cod')";
            $result = pg_query($conn, $query);
            if (!$result) {
                pg_query($conn, "ROLLBACK");
                die("Errore durante la registrazione del corso:"  . pg_last_error($conn));
            }
        
        } else {
            $corso= $_POST['corso'];
            echo $corso[1];
            $corso1=$corso[0];
            $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso1','$abb_cod')";
            $result = pg_query($conn, $query);
            if (!$result) {
                pg_query($conn, "ROLLBACK");
                die("Errore durante la registrazione dei corsi:"  . pg_last_error($conn));
            } 
            $corso2=$corso[1];

            $query = "INSERT INTO Prevede (corso, Abbonamento) VALUES ('$corso2','$abb_cod')";
            $result = pg_query($conn, $query);
            if (!$result) {
                pg_query($conn, "ROLLBACK");
                die("Errore durante la registrazione dei corsi:"  . pg_last_error($conn));
            } 
        }
    }

    //confirm the transaction if everything was successful
    pg_query($conn, "COMMIT");

    $_SESSION['registrazione']="Utente registrato con sucesso";

    header("Location: ../index.php");
    exit;

    pg_close($conn);

?>
