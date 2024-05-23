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
    <link rel="StyleSheet" href="../Style/utente.css">
    <link rel="StyleSheet" href="../Style/modal.css">

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
            
            <div class="linksito">
                <div class="login_btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="person flex">
                    <ul class="login_menu">
                        <!-- Condizione PHP per mostrare il menu di login -->
                        <?php if (!$logged) : ?>
                            <li>
                                <p class="bold"><b>Registrati o Accedi</b></p>
                            </li>
                            <li>
                                <p>Scopri tutte le funzionalità del sito</p>
                            </li>
                            <hr size="1" color="black">
                            <li>
                                <a href="login_registrazione/registration.php">
                                    <button class="Sign up">Registrati</button>
                                </a>
                            </li>
                            <li>
                                <button class="Sign in" id="mostraPopupButton">Accedi</button>
                            </li>
                        <?php else: ?>
                                <ul class="login_menu">
                                    <!-- Logout -->
                                    <form action="../php/logout.php" method="post" >
                                        <button class="Sign out" type="submit">Logout</button>
                                    </form>
                                </ul>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="hamburger_menu" onclick="showSidebar()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                </div>
        </div>
                <ul class="sidebar"> 
                    <li class="side_exit" onclick=hideSidebar()>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 
                            1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 
                            12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </li>
                    <li>
                        <h3 class="side_name">ADE Sporting Club</h3>
                    </li>
                    <li>
                    <a href="../index.php">Home</a>
                </li>
                <li>
                    <a href="../Struttura.php">Struttura</a>
                </li>
                <li>
                    <a href="../Attivita.php"> Attività</a>
                </li>               
                <li>
                    <a href="../Prenota.php">Prenota</a>
                </li>
            </ul>
            <!-- javascript for sidebar menu -->
            <script>
                function showSidebar() 
                {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.style.display = 'flex';
                }
                function hideSidebar()
                {
                    const sidebar = document.querySelector('.sidebar');
                    sidebar.style.display = 'none';
                }

                // funzione per mostrare il menu a tendina
const show_menu = document.querySelector('.login_btn');
  nav = document.querySelector('.person');

  show_menu.onclick = () => {
    nav.classList.toggle("show");
};
            </script>
            <!-- end javascript -->
        </nav>
        
    </header>  

    <div class="grid_gold">
<!-- USER PROFILE -->
        <div class="user_profile">
                <!-- caricamento foto profilo -->
                <div class="section">
                    <?php
                        $result = pg_query($conn, "SELECT * FROM Utente WHERE id = '{$_SESSION['id']}'");
                        $result2 = pg_query($conn, "SELECT * FROM Abbonamento a join Sottoscrizione s on s.Abbonamento = a.codice WHERE s.cliente = '{$_SESSION['id']}'");

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
                        if (pg_num_rows($result2) > 0) {
                            $row2 = pg_fetch_assoc($result2);
                            $data_sottoscrizione_intera=explode(" ",$row2['data_sottoscrizione']);
                            $data_sottoscrizione= $data_sottoscrizione_intera[0];
                            $tipo_abbonamento=$row2['tipo'];

                            // Assume che $row2['data_sottoscrizione'] contenga la data di inizio dell'abbonamento nel formato "YYYY-MM-DD"
                            $data_inizio = new DateTime($row2['data_sottoscrizione']);
                            // Determina la durata dell'abbonamento in base al tipo
                            switch ($tipo_abbonamento) {
                                case 'AM':
                                    $durata_abbonamento = new DateInterval('P1M'); // Periodo di 1 mese
                                    break;
                                case 'AT':
                                    $durata_abbonamento = new DateInterval('P3M'); // Periodo di 3 mesi
                                    break;
                                case 'AS':
                                    $durata_abbonamento = new DateInterval('P6M'); // Periodo di 6 mesi
                                    break;
                                case 'AA':
                                    $durata_abbonamento = new DateInterval('P1Y'); // Periodo di 1 anno
                                    break;
                                default:
                                    // Gestione dell'errore o comportamento predefinito
                                    break;
                            }

                            // Calcola la data di fine dell'abbonamento aggiungendo la durata al data di inizio
                            $data_fine = $data_inizio->add($durata_abbonamento);
                            // per visualizzarla correttamente va riconvertita nel giusto formato
                            $data_fine_abbonamento = $data_fine->format('Y-m-d');
                        } 
                    ?>
                    <form action="../php/caricaImmagine.php" method="post" name="caricamentoFoto" enctype="multipart/form-data">
                        <input type="file" id="fotoprof" name="fotoprof" accept=".png, .jpeg, .jpg"><br>
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
                
                <div class="section">
                    <h2>Dettagli abbonamento</h2>
                    <p><strong>Livello di abbonamento:</strong> <?php echo $_SESSION['livello']; ?></p>
                    <p><strong>Categoria di corso:</strong> <?php echo $row2['categoria']; ?></p>
                    <p><strong>Data sottoscrizione abbonamento:</strong> <?php echo $data_sottoscrizione; ?></p>
                    <p><strong>Data fine abbonamento:</strong><?php echo $data_fine_abbonamento ?></p>
                    <div class="subscription-progress">
                        <h4>stato avanzamento:</h4>
                        <div class="progress-bar">
                            <div class="progress-indicator"></div>
                        </div>
                    </div>
            </div>
        </div>
<!-- PER I SOCI GOLD -->
        <div class="informazioni">
            <h2>I TUOI VANTAGGI</h2>
            <p>In qualità di utente gold hai: <br>> libero accesso al bar della palestra <br>> sconti all'interno della nostra area ristoro <br>> precedenza nelle prenotazioni <br>> corsi privati messi a disposizone dagli insegnanti <br>> accesso esclusivo gli eventi organizzati dal circolo <br>
            <br>Nella sezione qui a destra potrai vedere tutti gli eventi a cui hai accesso</p>

        </div>
        <div class="eventi">
            <div id="event-container" class="grid-view">
                <!-- Contenuto degli eventi verrà caricato qui -->
                <?php
                // Definisci la query SQL
                $query = "SELECT * FROM evento WHERE giorno > CURRENT_DATE";

                // Esegui la query
                $result = pg_query($conn, $query) or die('Query failed: ' . pg_last_error());

                // Fetch all the result rows as an associative array
                $events = pg_fetch_all($result);

                // Mostra gli eventi
                if ($events) {
                    foreach ($events as $event) {
                        echo '<div class="event">';
                        echo '<h2>' . htmlspecialchars($event['titolo']) . '</h2>';
                        echo '<p>Data: ' . htmlspecialchars($event['giorno']) . '</p>';
                        // Format the time to show only hours and minutes
                        $time = strtotime($event['orario_inizio']);
                        echo '<p>Orario: ' . date('H:i', $time) . '</p>';
                        echo '<p>' . htmlspecialchars($event['descrizione']) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo 'Nessun evento trovato.';
                }
                ?>
            </div>

            <button id="toggle-view-btn-eventi" onclick="toggleViewEventi()">Visualizzazione: Griglia</button>

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
            <iframe name="chatframe" id="iframe-chat" style="width:100%; height:600px; display: none; border: none; "></iframe>
            <div class="wrapper" id="chat-home" style="display: block;">
                
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

    <script>
    /* BARRA DI PROGRESSO */
    var startDate = new Date("<?php echo $data_sottoscrizione; ?>");
        var endDate = new Date("<?php echo $data_fine_abbonamento; ?>");

        // Stampa le variabili nella console del browser per il debug
        console.log('Data sottoscrizione:', startDate);
        console.log('Data fine abbonamento:', endDate);

        function updateProgressBar(startDate, endDate) {
            var cDate = new Date();
            var progress = (cDate - startDate) / (endDate - startDate) * 100;

        var progressBar = document.querySelector('.progress-indicator');
        progressBar.style.width = progress + '%';
    }

        updateProgressBar(startDate, endDate);

        
document.body.addEventListener('click', function(e) {
    if(e.target.classList.contains('chat-link')) {
        document.getElementById('iframe-chat').style.display = 'block'; // Show the iframe
        document.getElementById('chat-home').style.display = 'none'; // Hide the chat area
    }
});
window.addEventListener('message', function(event) {
    if (event.data === 'closeChat') {
        document.getElementById('iframe-chat').style.display = 'none'; // Hide the iframe
        document.getElementById('chat-home').style.display = 'block'; // Show the chat area
    }
});
</script>
</body>
</html>
