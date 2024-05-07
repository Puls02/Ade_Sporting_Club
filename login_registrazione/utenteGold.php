<?php
    session_start();

    // Verifica se l'utente è loggato
    if (!isset($_SESSION['username'])) {
        // Se non è loggato, reindirizza alla pagina di login
        header('Location: login.php');
        exit();
    }

    if (isset($_POST['logout'])) {
        session_unset(); // Rimuove tutte le variabili di sessione
        session_destroy(); // Distrugge la sessione
    
        header('Location: index.php'); // Reindirizza alla pagina di login
        exit();
    }
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
                    <a class="toolbar_link_Struttura" href="../Struttura.html">Struttura</a>
                </li>
                <li>
                    <a class="toolbar_link_Attivita" href="../Attivita.html"> Attività</a>
                </li>             
                <li>
                    <a class="toolbar_link_Prenota" href="../Prenota.html">Prenota</a>
                </li>
                <li>
                    <a class="toolbar_link_Soci" href="../Soci.html">Soci</a> 
                </li>
            </ul>

            <!--container for login features--> <!--Inserire un link sign in, sign up e un bottone con l'immagine che se cliccato ti apre un menu con accedi e registrati-->
            <div class="person flex">
                <ul class="login_menu">
                    <!-- POPUP DEL LOGIN -->
                    <li><button id="mostraPopupButton">Accedi</button></li>
                    <li><a href="registration.php"><button>Registrati</button></a></li>
                </ul>
            </div>
            
        </nav>
        
    </header>
    <div class="grid">
        <div class="user_profile">
            <h2>Profilo utente</h2>
                <!-- caricamento foto profilo -->
                <div class="profile-picture">
                    <label for="profile-image">Carica Foto Profilo:</label>
                    <div id="profile-image-preview" class="profile-image-preview"></div>
                    <input type="file" id="profile-image" accept="../image/*" onchange="previewProfileImage(event)">
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
        <div class="message">
            <h2>Bacheca Messaggi</h2>
            <!-- Inserisci qui la bacheca dei messaggi -->
        </div>
        <div class="chat" id="chat-column">
            <h2>Chat</h2>
            <div class="chat-list">
                <div class="chat-item" onclick="showChat(1)">Chat 1</div>
                <div class="chat-item" onclick="showChat(2)">Chat 2</div>
                <div class="chat-item" onclick="showChat(3)">Chat 3</div>
            </div>
            <div class="chat-messages">
                <div class="chat-message active-chat" id="chat1">
                    Contenuto della Chat 1
                </div>
                <div class="chat-message" id="chat2">
                    Contenuto della Chat 2
                </div>
                <div class="chat-message" id="chat3">
                    Contenuto della Chat 3
                </div>
            </div>
        </div>
        <div class="programmi">
            <h2>Programmi allenamento</h2>
            <div class="courses" id="courses-container">
                <!-- Corsi verranno aggiunti qui -->
            </div>
            <div class="switch-button">
                <button onclick="toggleView()">Cambia Visualizzazione</button>
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

        // Funzione per mostrare solo la chat selezionata
        function showChat(chatId) {
            const chatMessages = document.querySelectorAll('.chat-message');
            chatMessages.forEach(chat => chat.classList.remove('active-chat'));
            document.getElementById(`chat${chatId}`).classList.add('active-chat');
        }

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
// PROFILO UTENTE   
        function previewProfileImage(event) {
            const preview = document.getElementById('profile-image-preview');
            const file = event.target.files[0];
            const reader = new FileReader();
            const fileInput = document.getElementById('profile-image');

            reader.onload = function() {
                const image = new Image();
                image.src = reader.result;
                image.style.maxWidth = '300px';
                image.style.height = 'auto';
                preview.innerHTML = '';
                preview.appendChild(image);
                fileInput.value = ''; // Resetta il valore dell'input per permettere di selezionare nuovamente lo stesso file
                changeButtonLabel(); // Chiamata alla funzione per cambiare il testo del pulsante
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Funzione per cambiare il testo del pulsante a "Cambia Immagine" dopo il caricamento dell'immagine
        function changeButtonLabel() {
            const fileInput = document.getElementById('profile-image');
            fileInput.removeAttribute('data-changed'); // Imposta un attributo per indicare che l'immagine è stata cambiata
            fileInput.value = 'Cambia Immagine'; // Cambia il testo del pulsante
        }
    </script>
</body>
</html>
