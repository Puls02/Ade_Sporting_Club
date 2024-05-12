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
    <title>Pagina Riservata Soci Gold</title>
    <link rel="StyleSheet" href="../Style/utility.css">
    <link rel="StyleSheet" href="../Style/navbarStatic.css">
    <link rel="StyleSheet" href="../Style/login.css">
    <link rel="StyleSheet" href="../Style/utente.css">

    <!-- <link rel="StyleSheet" href="../chat/stile.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js/users.js" defer></script>
    
    <script src="../js/login.js" defer></script>
    <script src="../js/navbar.js" defer></script>
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
                <li>
                    <a class="toolbar_link_Soci" href="../Soci.html">Soci</a> 
                </li>
            </ul>

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
                            <button type="submit">Logout</button>
                        </form>
                    </ul>
                </div>
            <?php endif; ?>
            
        </nav>
        
    </header>  

    <div class="grid">
        <div class="user_profile">
            <h2>Profilo utente</h2>
                <!-- caricamento foto profilo -->
                <div class="profile-picture">
                <?php
                    $result = pg_query($conn, "SELECT * FROM Utente WHERE id = '{$_SESSION['id']}'");

                    if (pg_num_rows($result) > 0) {
                        $row = pg_fetch_assoc($result);
                        // Verifica se l'utente ha un'immagine di profilo
                        if (isset($row['Foto_profilo']) && $row['Foto_profilo'] !== null) {
                            // L'utente ha un'immagine di profilo, visualizzala
                            $immagine_codificata = base64_encode($row['Foto_profilo']);
                            echo '<img class="foto-utente" src="data:image/jpeg;base64,'.$immagine_codificata.'" />';
                        } else {
                            // Nessuna immagine di profilo per questo utente, mostra l'immagine predefinita
                            echo '<img class="foto-utente" src="../immagini/photo-camera.png" alt="Immagine di profilo predefinita" />';
                        }
                    } 
                ?>
                    <label>Carica Foto Profilo:</label>
                    <input type="file" id="foto_profilo" name="fotoprof" value="foto profilo" accept=".pdf, .png, .jpeg" multiple>
                </div>
                <!-- dettagli utente -->
                <div class="profile-details">
                    <p><strong>Nome:</strong> <?php echo  $_SESSION['name'] ?></p>
                    <p><strong>Cognome:</strong> <?php echo $_SESSION['surname']; ?></p>
                    <p><strong>Data di nascita:</strong> <?php echo $_SESSION['data_nascita']; ?></p>
                    <p><strong>Livello di abbonamento:</strong> <?php echo $_SESSION['livello']; ?></p>
                    <p><strong>Data sottoscrizione abbonamento:</strong> <?php echo $_SESSION['data_sottoscrizione']; ?></p>
                </div>
        </div>
        
        <div class="calendar">
            <h2>Calendario Settimanale</h2>
            <div class="weekly-schedule" id="weekly-schedule">
                <!-- Il calendario settimanale verrà generato qui -->
            </div>
        </div>
        <div class="chat" id="chat-column">
            <h2>Chat</h2>
            <div class="wrapper">
                <section class="users">
                <header>
                    <div class="content">
                        <?php
                            $result = pg_query($conn, "SELECT * FROM Utente WHERE id = '{$_SESSION['id']}'");

                            if (pg_num_rows($result) > 0) {
                                $row = pg_fetch_assoc($result);
                                // Verifica se l'utente ha un'immagine di profilo
                                if (isset($row['Foto_profilo']) && $row['Foto_profilo'] !== null) {
                                    // L'utente ha un'immagine di profilo, visualizzala
                                    $immagine_codificata = base64_encode($row['Foto_profilo']);
                                    echo '<img src="data:image/jpeg;base64,'.$immagine_codificata.'" />';
                                } else {
                                    // Nessuna immagine di profilo per questo utente, mostra l'immagine predefinita
                                    echo '<img src="../immagini/photo-camera.png" alt="Immagine di profilo predefinita" />';
                                }
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
        // Funzione per generare i giorni della settimana
        function generateWeekDays() {
            const daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];
            const currentDate = new Date();
            const todayIndex = currentDate.getDay();
            const weekDays = [];

            for (let i = 0; i < 7; i++) {
                const currentDate = new Date();
                currentDate.setDate(currentDate.getDate() + i);
                const index = currentDate.getDay();
                const day = daysOfWeek[index];
                const dayNumber = currentDate.getDate();
                weekDays.push({ day, dayNumber });
            }

            return weekDays;
        }

        // Funzione per aggiungere i giorni e le attività al calendario settimanale
        function addWeekDaysToSchedule() {
            const weekDays = generateWeekDays();
            const scheduleElement = document.getElementById('weekly-schedule');

            weekDays.forEach((day, index) => {
                const dayAndActivityElement = document.createElement('div');
                dayAndActivityElement.classList.add('day-and-activity');
                dayAndActivityElement.classList.add(`activity-${index + 1}`);

                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.innerHTML = `<h1>${day.dayNumber}</h1><p>${day.day}</p>`;

                const activityElement = document.createElement('div');
                activityElement.classList.add('activity');
                activityElement.innerHTML = `<h2>Attività ${index + 1}</h2><p>Descrizione dell'attività</p>`;

                dayAndActivityElement.appendChild(dayElement);
                dayAndActivityElement.appendChild(activityElement);

                scheduleElement.appendChild(dayAndActivityElement);
            });
        }

        // Chiamata alla funzione per aggiungere i giorni e le attività al calendario settimanale
        addWeekDaysToSchedule();

        // Array dei corsi di allenamento
        const courses = ['Nuoto', 'Paddle', 'Tennis', 'Calcio', 'Palestra', 'Basket'];
        let gridView = true; // Vista iniziale: griglia

        // Funzione per aggiungere i corsi al container
        function addCoursesToContainer() {
            const coursesContainer = document.getElementById('courses-container');
            coursesContainer.innerHTML = '';

            courses.forEach(course => {
                const courseElement = document.createElement('div');
                courseElement.classList.add('course');
                courseElement.textContent = course;
                coursesContainer.appendChild(courseElement);
            });
        }

        // Funzione per cambiare la visualizzazione tra griglia e elenco
        function toggleView() {
            const coursesContainer = document.getElementById('courses-container');
            if (gridView) {
                coursesContainer.classList.remove('courses');
                coursesContainer.classList.add('courses-list');
            } else {
                coursesContainer.classList.remove('courses-list');
                coursesContainer.classList.add('courses');
            }
            gridView = !gridView;
        }

        // Aggiunta iniziale dei corsi al container
        addCoursesToContainer();

    </script>
</body>
</html>
