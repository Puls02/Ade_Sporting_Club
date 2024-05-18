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

    <div class="grid">
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
                
                <div class="section">
                    <h2>Dettagli abbonamento</h2>
                    <p><strong>Livello di abbonamento:</strong> <?php echo $_SESSION['livello']; ?></p>
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

    <script>
    function updateProgressBar(startDate, endDate) {
        var currentDate = new Date();
        var start = new Date(startDate);
        var end = new Date(endDate);

        // Stampa le variabili nella console del browser per il debug
    console.log('Data sottoscrizione:', currentDate);
    console.log('Data fine abbonamento:', start);
    console.log('Data fine abbonamento:', end);

        var elapsed = currentDate - start;
        var totalDuration = end - start;
        var progress = (elapsed / totalDuration) * 100;

        // Assicura che la percentuale di avanzamento non superi il 100%
        progress = Math.min(progress, 100);

        var progressBar = document.querySelector('.progress-indicator');
        progressBar.style.width = progress + '%';
    }

    updateProgressBar('24-04-2024', '<?php echo $data_fine_abbonamento; ?>');
</script>

</body>
</html>
