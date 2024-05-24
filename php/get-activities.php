<?php
    //Start the session
    session_start();
    //Connection to the database
    include_once "config.php";

    //Set the localization to Italian
    setlocale(LC_TIME, 'it_IT.UTF-8');

    $daysOfWeekMap = array(
        'Monday' => 'Monday',
        'Tuesday' => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday' => 'Thursday',
        'Friday' => 'Friday',
        'Saturday' => 'Saturday',
        'Sunday' => 'Sunday'
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
                //istruttore
                $result = pg_query_params($conn, "SELECT *FROM prenotazione WHERE utente = $1 AND data = $2", array($_SESSION['id'], $selectedDate));
                $result2 = pg_query_params($conn,"SELECT o.Name AS name, o.category AS category, o.week_day AS day, o.start_time AS StartTime, o.end_time AS EndTime FROM Instructor i JOIN Teaching s ON i.ID = s.Instructor JOIN Times or ON s.Course = o.Name WHERE i.ID = $1 AND o.week_day = '".$dayOfWeekItalian."'", array($_SESSION['id']));
            
                //Check if the instructor teaches gym (because gym is not among the courses taught but I would like him to do something)
                $isPalestraInstructor = false;
                $palestraQuery = pg_query_params($conn, "SELECT 1 FROM Istruttore i JOIN Insegna s ON i.ID = s.Istruttore WHERE i.ID = $1 AND s.Corso = 'Palestra'", array($_SESSION['id']));
                if ($palestraQuery && pg_num_rows($palestraQuery) > 0) {
                    $isPalestraInstructor = true;
                }
            } else {
                //utente
                $result = pg_query_params($conn, "SELECT *FROM reservation WHERE user = $1 AND data = $2", array($_SESSION['id'], $selectedDate));
                $result2 = pg_query_params($conn,"
                SELECT o.Name AS name, o.category AS category, o.day_week AS day, o.start_time AS StartTime, o.end_time AS EndTime
                FROM User u JOIN Customer c ON u.ID = c.ID JOIN Subscription s ON c.ID = s.Customer JOIN Subscription to ON s.Subscription = a.Code JOIN Provides p ON a.Code = p.Subscription JOIN Times o ON p.Course = o.Name 
                WHERE u.Corsi = TRUE AND u.ID = $1 AND o.giorno_settimana = '".$dayOfWeekItalian."' AND o.categoria = a.categoria;", array($_SESSION['id']));
            }
            
            if ($result && $result2) {
                $bookings = array();
                $courses = array();
                //Fetch the results of the first query and save to an array
                while ($row = pg_fetch_assoc($result)) {
                    $bookings[] = $row;
                }
                //Fetch the results of the second query and save to the same array
                while ($row = pg_fetch_assoc($result2)) {
                    $courses[] = $row;
                }
                //Add the "Gym" activity if the user is a gym instructor
                if (isset($isGymInstructor) && $isGymInstructor) {
                    $courses[] = array(
                        'name' => 'gym',
                        'day' => $dayOfWeekItalian,
                        'starttime' => '08:00:00',
                        'end time' => '22:00:00'
                    );
                }
                //Return activity data as JSON
                echo json_encode(['bookings' => $bookings,'courses' => $courses]);
            } else {
                error_log("Error in query: " . pg_last_error($conn));
                echo json_encode(array("error" => "No tasks found for the selected date."));
            }
        } else {
            echo json_encode(array("error" => "Invalid date format."));
        }
    } else {
        //Debug: Print an error message if the 'date' parameter is missing
        error_log("Parameter 'date' missing in request.");
        echo json_encode(array("error" => "Parameter 'date' missing in request."));
    }

    //Close the database connection
    pg_close($conn);
?>
