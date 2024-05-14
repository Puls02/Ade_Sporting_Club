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
            <h2>Profilo utente</h2>
                <!-- caricamento foto profilo -->
                <div class="profile-picture">
                <?php
                    $result = pg_query($conn, "SELECT * FROM Utente WHERE id = '{$_SESSION['id']}'");

                    if (pg_num_rows($result) > 0) {
                        $row = pg_fetch_assoc($result);
                        $foto_profilo_bytea = $row['foto_profilo'];

                        // Se c'è un'immagine di profilo, la decodifichiamo e la mostriamo
                        if ($foto_profilo_bytea !== null) {
                            // Decodifica i dati bytea
                            $foto_decodata = pg_unescape_bytea($foto_profilo_bytea);
                            
                            // Stampa l'immagine 
                            echo "<img src='data:image/jpeg;base64," . base64_encode($foto_decodata) . "' alt='Foto Profilo' width='auto' height='200'><br>";
                        } else {
                            // Se non c'è un'immagine di profilo, mostra un messaggio
                            echo '<img class="foto-utente" src="../immagini/photo-camera.png" alt="Immagine di profilo predefinita" />';
                        }
                    } 
                ?>
                    <form action="../php/caricaImmagine.php" method="post" name="caricamentoFoto" enctype="multipart/form-data">
                        <label>Carica Foto Profilo:</label>
                        <input type="file" id="fotoprof" name="fotoprof" accept=".png, .jpeg"><br>
                        <button type="submit" name="submit">Carica Immagine</button>
                    </form>
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

<!-- WEEKLY SCHEDULE -->        
        <div class="calendar">
            <h2>Calendario Settimanale</h2>
            <div class="weekly-schedule" id="weekly-schedule">
                <!-- Il calendario settimanale verrà generato qui -->
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
        

document.addEventListener('DOMContentLoaded', function() {
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

        // Funzione per mappare i giorni della settimana nel formato desiderato
function mapWeekDay(day) {
    const dayMapping = {
        'Dom': 'domenica',
        'Lun': 'lunedi',
        'Mar': 'martedi',
        'Mer': 'mercoledi',
        'Gio': 'giovedi',
        'Ven': 'venerdi',
        'Sab': 'sabato'
    };
    return dayMapping[day];
}

// Funzione per ottenere il colore in base al nome dell'attività
function getActivityColor(activityName) {
    switch (activityName.toLowerCase()) {
        case 'calcio':
            return '#a7c957';
        case 'tennis':
            return '#ffbf69';
        case 'nuoto':
            return '#a8dadc';
        case 'basket':
            return '#f7c59f';
        case 'paddle':
            return '#fff3b0';
        default:
            return 'gray'; // Colore di default nel caso in cui non corrisponda a nessuna attività specificata
    }
}

// Funzione per aggiungere i giorni e le attività al calendario settimanale
function addWeekDaysToSchedule() {
    const weekDays = generateWeekDays();
    const scheduleElement = document.getElementById('weekly-schedule');

    // Chiamata AJAX per ottenere le attività dal database
    fetch('../php/get-activities.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Errore nella richiesta al server.');
            }
            return response.json();
        })
        .then(data => {
            weekDays.forEach((day, index) => {
                const dayAndActivityElement = document.createElement('div');
                dayAndActivityElement.classList.add('day-and-activity');
                dayAndActivityElement.classList.add(`activity-${index + 1}`);

                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.innerHTML = `<h1>${day.dayNumber}</h1><p>${day.day}</p>`;

                const activityElement = document.createElement('div');
                activityElement.classList.add('activity');
                
                // Trova le attività per il giorno corrente
                const dayKey = mapWeekDay(day.day);
                const activitiesForDay = data.filter(activity => activity.giorno.toLowerCase() === dayKey);
                activitiesForDay.forEach(activity => {
                    const activityInfo = document.createElement('p');
                    activityInfo.innerHTML = `<strong>${activity.corso}</strong> ${activity.orarioinizio.slice(0, 5)} - ${activity.orariofine.slice(0, 5)}`;
                    
                    // Assegna lo sfondo colorato in base al nome dell'attività
                    const activityColor = getActivityColor(activity.corso);
                    activityInfo.style.backgroundColor = activityColor;
                    activityInfo.classList.add('activity-item');

                    activityElement.appendChild(activityInfo);
                });

                dayAndActivityElement.appendChild(dayElement);
                dayAndActivityElement.appendChild(activityElement);

                scheduleElement.appendChild(dayAndActivityElement);
            });
        })
        .catch(error => console.error('Errore durante la richiesta AJAX:', error)); // Gestione degli errori
}

        // Chiamata alla funzione per aggiungere i giorni e le attività al calendario settimanale
        addWeekDaysToSchedule();
    });



    </script>
</body>
</html>
