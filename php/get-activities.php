<?php
    //Start the session
    session_start();
    //Connection to the database
    include_once "config.php";

    //Set the localization to Italian
    setlocale(LC_TIME, 'it_IT.UTF-8');

    $daysOfWeekMap = array(
        'Monday' => 'lunedi',
        'Tuesday' => 'martedi',
        'Wednesday' => 'mercoledi',
        'Thursday' => 'giovedi',
        'Friday' => 'venerdi',
        'Saturday' => 'sabato',
        'Sunday' => 'domenica'
    );

    //Retrieve the selected date (passed as GET parameter)
    if(isset($_GET['date'])) {
        $selectedDate = $_GET['date'];

        //Debug: print the value of the 'date' parameter
        error_log("Parameter 'date' received: " . $selectedDate);

        //Sanitize the parameter to avoid SQL injection
        $selectedDate = filter_var($selectedDate, FILTER_SANITIZE_STRING);

        //Verify that the date is in correct format
        $dateObject = DateTime::createFromFormat('Y-m-d', $selectedDate);
        if ($dateObject !== false) {
            //Get the day of the week in English
            $dayOfWeekEnglish = $dateObject->format('l');
            //Map the day of the week to Italian
            $dayOfWeekItalian = $daysOfWeekMap[$dayOfWeekEnglish];

            if ($_SESSION['id'] < 30) {
                // istruttore
                $result = pg_query_params($conn, "SELECT * FROM prenotazione WHERE utente = $1 AND data = $2", array($_SESSION['id'], $selectedDate));
                $result2 = pg_query_params($conn,"SELECT o.Nome AS nome, o.categoria AS categoria, o.giorno_settimana AS giorno, o.ora_inizio AS OraInizio, o.ora_fine AS OraFine FROM Istruttore i JOIN Insegna s ON i.ID = s.Istruttore JOIN Orari o ON s.Corso = o.Nome WHERE i.ID = $1 AND o.giorno_settimana = '".$dayOfWeekItalian."'", array($_SESSION['id']));
    
                // Verifica se l'istruttore insegna palestra (perchè palestra non è tra i corsi insegnati ma vorrei fargli fa qualcosa)
                $isPalestraInstructor = false;
                $palestraQuery = pg_query_params($conn, "SELECT 1 FROM Istruttore i JOIN Insegna s ON i.ID = s.Istruttore WHERE i.ID = $1 AND s.Corso = 'Palestra'", array($_SESSION['id']));
                if ($palestraQuery && pg_num_rows($palestraQuery) > 0) {
                    $isPalestraInstructor = true;
                }
            } else {
                // utente
                $result = pg_query_params($conn, "SELECT * FROM prenotazione WHERE utente = $1 AND data = $2", array($_SESSION['id'], $selectedDate));
                $result2 = pg_query_params($conn,"
                SELECT o.Nome AS nome, o.categoria AS categoria, o.giorno_settimana AS giorno, o.ora_inizio AS OraInizio, o.ora_fine AS OraFine
                FROM Utente u JOIN Cliente c ON u.ID = c.ID JOIN Sottoscrizione s ON c.ID = s.Cliente JOIN Abbonamento a ON s.Abbonamento = a.Codice JOIN Prevede p ON a.Codice = p.Abbonamento JOIN Orari o ON p.Corso = o.Nome 
                WHERE u.Corsi = TRUE AND u.ID = $1 AND o.giorno_settimana = '".$dayOfWeekItalian."' AND o.categoria = a.categoria;", array($_SESSION['id']));
            }
    
            if ($result && $result2) {
                $prenotazioni = array();
                $corsi = array();
                // Fetch dei risultati della prima query e salvataggio in un array
                while ($row = pg_fetch_assoc($result)) {
                    $prenotazioni[] = $row;
                }
                // Fetch dei risultati della seconda query e salvataggio nello stesso array
                while ($row = pg_fetch_assoc($result2)) {
                    $corsi[] = $row;
                }
                // Aggiungi l'attività "Palestra" se l'utente è un istruttore di palestra
                if (isset($isPalestraInstructor) && $isPalestraInstructor) {
                    $corsi[] = array(
                        'nome' => 'palestra',
                        'giorno' => $dayOfWeekItalian,
                        'orainizio' => '08:00:00',
                        'orafine' => '22:00:00'
                    );
                }
                //Return activity data as JSON
                echo json_encode(['prenotazioni' => $prenotazioni,'corsi' => $corsi]);
            } else {
                error_log("Errore nella query: " . pg_last_error($conn));
                echo json_encode(array("error" => "Nessuna attività trovata per la data selezionata."));
            }
        } else {
            echo json_encode(array("error" => "Formato data non valido."));
        }
    } else {
        // Debug: stampa un messaggio di errore se il parametro 'date' manca
        error_log("Parametro 'date' mancante nella richiesta.");
        echo json_encode(array("error" => "Parametro 'date' mancante nella richiesta."));
    }

    //Close the database connection
    pg_close($conn);
?>
