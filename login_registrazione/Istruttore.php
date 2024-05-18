<?php
    session_start();
    $logged=isset($_SESSION['logged_in']);
    include_once "../php/config.php";
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Utente</title>
    <link rel="StyleSheet" href="../Style/utility.css">
    <link rel="StyleSheet" href="../Style/navbar.css">
    <link rel="StyleSheet" href="../Style/login.css">
    <link rel="StyleSheet" href="../Style/utente.css">

    <!-- <link rel="StyleSheet" href="../chat/stile.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/users.js" defer></script>
    <script src="../js/dashboard.js" defer></script>

</head>
<body>
    <!--Header, there is the navbar menu and login-->
    <header id="beginning"> 
        <nav class="nav responsive">
            <!--container for logo and name-->
            <ul class="logo container"> 
                <li>
                    <img class="logo_img" src="../immagini/logo/Ade.jpg">
                </li>
                <li>
                    <a class="logo_name">ADE Sporting Club</a>                
                </li>
            </ul>
            <!--container for navbar, topBotomBordersOut is the name of the toolbar animation-->
            <ul class="toolbar container topBotomBordersOut"> 
                <li>
                    <a class="toolbar_link_Home" href="../index.php">Home</a>
                </li>
                <li>
                    <a class="toolbar_link_Struttura" href="../Struttura.php">Struttura</a>
                </li>
                <li>
                    <a class="toolbar_link_Attivita" href="../Attivita.php"> Attività</a>
                </li>             
                <li>
                    <a class="toolbar_link_Prenota" href="../Prenota.php">Prenota</a>
                </li>
            </ul>
            <div class="login_btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
            </div>
            <!--container for login features--> <!--Inserire un link sign in, sign up e un bottone con l'immagine che se cliccato ti apre un menu con accedi e registrati-->
            <?php if(!$logged) :?>
                <div class="person flex">
                    <ul class="login_menu">
                        <!-- POPUP DEL LOGIN -->
                        <li>
                            <button id="mostraPopupButton">Accedi</button>
                        </li>
                        <li>
                            <a href="login_registrazione/registration.php">
                                <button>Registrati</button>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="person flex">
                    <ul class="login_menu">
                        <!-- Logout -->
                        <form action="../php/logout.php" method="post" >
                            <button class="Sign out" type="submit">Logout</button>
                        </form>
                    </ul>
                </div>
            <?php endif; ?>

        <!--open the dropdown login menu on click-->
        <script type="text/javascript">
                const show_menu = document.querySelector('.login_btn');
                const nav = document.querySelector('.person');

                show_menu.onclick = () => {
                    nav.classList.toggle("show");
                };
            </script>
            
        </nav>
        
    </header>  

    <div class="grid_istruttore">
<!-- USER PROFILE -->
        <div class="user_profile">
                <!-- caricamento foto profilo -->
                <div class="section">
                    <?php
                        $result = pg_query($conn, "SELECT * FROM Istruttore WHERE id = '{$_SESSION['id']}'");

                        if (pg_num_rows($result) > 0) {
                            $row = pg_fetch_assoc($result);
                            $foto_profilo_bytea = $row['foto_profilo'];

                            // Se c'è un'immagine di profilo, la decodifichiamo e la mostriamo
                            if ($foto_profilo_bytea !== null) {
                                // Decodifica i dati bytea
                                $foto_decodata = pg_unescape_bytea($foto_profilo_bytea);
                                
                                // Stampa l'immagine 
                                echo "<img src='data:image/jpeg;base64," . base64_encode($foto_decodata) . "' alt='Foto Profilo' width='auto' height='200'><br>";
                                echo "<label>Cambia l'immagine</label>";
                            } else {
                                // Se non c'è un'immagine di profilo, mostra un messaggio
                                echo '<img src="../immagini/photo-camera.png" alt="Immagine di profilo predefinita" width="auto" height="200">';
                                echo "<label>Inserisci un'immagine</label>";
                            }
                        } 
                         
                    ?>
                    <form action="../php/caricaImmagine.php" method="post" name="caricamentoFoto" enctype="multipart/form-data">
                        <input type="file" id="fotoprof" name="fotoprof" accept=".png, .jpeg"><br>
                        <button type="submit" name="submit">Carica</button>
                    </form>
                </div>
                <!-- dettagli utente -->
                
                <div class="section">
                    <h2>Informazioni personali</h2>
                    <p><strong>Nome:</strong> <?php echo  $_SESSION['name'] ?></p>
                    <p><strong>Cognome:</strong> <?php echo $_SESSION['surname']; ?></p>
                    <p><strong>Data di nascita:</strong> <?php echo $_SESSION['data_nascita']; ?></p>
                    <p><strong>E-mail:</strong> <?php echo $_SESSION['mail']; ?></p>
                    <p><strong>Numero di telefono:</strong> <?php echo $_SESSION['phone']; ?></p>
                </div>
        </div>
<!-- PER I SOCI GOLD -->
        <div class="informazioni">
            <div id="course-container" class="grid-view">
                <!-- Contenuto degli eventi verrà caricato qui -->
                <?php
                // Connect to the database
                $dbconn = pg_connect("host=localhost dbname=Ade_Sporting_Club user=postgres password=eleonora") or die('Could not connect: ' . pg_last_error());

                    // CAMBIARE E INSERIRE I CORSI CHE L'ISTRUTTORE PUO' GESTIRE

                // Define the SQL query
                $query = "SELECT ist.nome,ins.corso,o.categoria,o.giorno_settimana,o.ora_inizio,o.ora_fine FROM (istruttore ist join insegna ins on ins.istruttore = ist.id) join orari o on o.nome = ins.corso where ist.id = {$_SESSION['id']}";
                

                // Execute the query
                $result = pg_query($query) or die('Query failed: ' . pg_last_error());

                // Fetch all the result rows as an associative array
                $events = pg_fetch_all($result);

                // Create an associative array to group the events
                $groupedEvents = [];

                // Group the events by corso and categoria
                foreach ($events as $event) {
                    $key = $event['corso'] . '-' . $event['categoria'];

                    if (!isset($groupedEvents[$key])) {
                        $groupedEvents[$key] = [
                            'corso' => $event['corso'],
                            'categoria' => $event['categoria'],
                            'times' => []
                        ];
                    }

                    $groupedEvents[$key]['times'][] = [
                        'giorno_settimana' => $event['giorno_settimana'],
                        'ora_inizio' => $event['ora_inizio'],
                        'ora_fine' => $event['ora_fine']
                    ];
                }

                // Display the grouped events
                foreach ($groupedEvents as $event) {
                    echo '<div class="event">';
                    echo '<h2>' . $event['corso'] . '</h2>';
                    echo '<p>Categoria: ' . $event['categoria'] . '</p>';

                    foreach ($event['times'] as $time) {
                        echo '<p>Data: ' . $time['giorno_settimana'] . '</p>';
                        echo '<p>Orario: ' . $time['ora_inizio'] . ' - ' . $time['ora_fine'] . ' </p>';
                    }

                    echo '</div>';
                }
                ?>
            </div>

            <button id="toggle-view-btn-corsi" onclick="toggleViewCorsi()">Visualizzazione: Griglia</button>
        </div>
        <div class="eventi">
            <div id="event-container" class="grid-view">
                <!-- Contenuto degli eventi verrà caricato qui -->
                <?php
                // Connect to the database
                $dbconn = pg_connect("host=localhost dbname=Ade_Sporting_Club user=postgres password=eleonora") or die('Could not connect: ' . pg_last_error());

                // Define the SQL query
                $query = 'SELECT * FROM evento';

                // Execute the query
                $result = pg_query($query) or die('Query failed: ' . pg_last_error());

                // Fetch all the result rows as an associative array
                $events = pg_fetch_all($result);

                // Mostra gli eventi
                foreach ($events as $event) {
                    echo '<div class="event">';
                    echo '<h2>' . $event['titolo'] . '</h2>';
                    echo '<p>Data: ' . $event['giorno'] . '</p>';
                    echo '<p>Orario: ' . $event['orario_inizio'] . '</p>';
                    echo '<p>' . $event['descrizione'] . '</p>';
                    echo '</div>';
                }
                ?>
            </div>

            <button id="toggle-view-btn-eventi" onclick="toggleViewEventi()">Visualizzazione: Griglia</button>

            <!-- Button to open the new event form -->
    <button id="new-event-btn" onclick="document.getElementById('new-event-form').style.display='block'">Nuovo Evento</button>

<!-- Form to create a new event -->
<div id="new-event-form" style="display: none;">
    <form action="../php/insert-event.php" method="post">
        <label for="titolo">Titolo:</label>
        <input type="text" id="titolo" name="titolo" required>

        <label for="giorno">Data:</label>
        <input type="date" id="giorno" name="giorno" required>

        <label for="orario_inizio">Orario:</label>
        <input type="time" id="orario_inizio" name="orario_inizio" required>

        <label for="descrizione">Descrizione:</label>
        <textarea id="descrizione" name="descrizione" required></textarea>

        <input type="submit" value="Crea Evento">
    </form>
</div>
        </div>

<!-- WEEKLY SCHEDULE -->        
        <div class="calendario">
            <h2 id="currentMonth"></h2>
            <div id="calendar">

            </div>
        </div>
        <div class="weekly-schedule">
            <div class="schedule-date">

            </div>
            <!-- Qui verrà aggiunta la data e le attività -->
            <div class="schedule-activity">

            </div>
        </div>

<!-- CHAT -->
        <div class="chat" id="chat-column">
            <h2>Chat</h2>
            <div class="wrapper">
                <section class="users">
                <header>
                    <div class="content">
                        <?php
                            if ($foto_profilo_bytea !== null) {
                                // Decodifica i dati bytea
                                $foto_decodata = pg_unescape_bytea($foto_profilo_bytea);
                                
                                // Stampa l'immagine 
                                echo "<img src='data:image/jpeg;base64," . base64_encode($foto_decodata) . "' alt='Foto Profilo' width='auto' height='200'><br>";
                            } else {
                                // Se non c'è un'immagine di profilo, mostra un messaggio
                                echo '<img class="foto-utente" src="../immagini/photo-camera.png" alt="Immagine di profilo predefinita" />';
                            }
                        ?>                        
                        <div class="details">
                            <span><?php echo $row['nome'] . " " . $row['cognome']; ?></span>
                            <p><?php if($row['status'] == true) { echo 'online'; } else { echo 'offline'; }; ?></p>
                        </div>
                    </div>
                </header>
                <div class="search">
                    <span class="text">Select an user to start chat</span>
                    <input type="text" placeholder="Enter name to search...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">
            
                </div>
                </section>
            </div>
        </div>
        
    </div>
</body>
</html>