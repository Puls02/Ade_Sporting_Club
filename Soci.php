<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Riservata Soci Gold</title>
    <link rel="StyleSheet" href="Style/utility.css">
    <link rel="StyleSheet" href="Style/navbarStatic.css">
    <style>
        /* CSS per il layout generale */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .grid {
            display: grid;
            grid-template: 'a a a' 'b c d' 'e e d';
            border-radius: 10px;
            gap: 10px;
            height: 100vh; /* Imposta l'altezza della griglia al 100% dell'altezza della finestra */
        }
        .user_profile {
            grid-area: a;
            background-color: white;
            border-radius: 10px;
            border: 1px solid black;
            position: relative;
            height: 300px;
        }
        .calendar {
            grid-area: b;
            background-color: white;
            border-radius: 10px;
            border: 1px solid black;
            position: relative;
        }
        .message {
            grid-area: c;
            background-color: white;
            border-radius: 10px;
            border: 1px solid black;
            position: relative;
        }
        .chat {
            grid-area: d;
            background-color: white;
            border-radius: 10px;
            border: 1px solid black;
            overflow-y: auto;
            /* Altezza della colonna della chat pari all'80% dell'altezza della finestra */
            height: 80vh; 
            position: relative;
        }
        .programmi {
            grid-area: e;
            background-color: white;
            border-radius: 10px;
            border: 1px solid black;
            position: relative;
        } 
        h2 {
            color: #333;
        }

        /* CSS per la pianificazione settimanale */
        .weekly-schedule {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }

        .weekly-schedule h1 {
            margin-top: 20px;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .day-and-activity {
            display: grid;
            grid-template-columns: 15% 60% 25%;
            align-items: center;
            border-radius: 14px;
            margin-bottom: 5px;
            color: #484d53;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 3px;
        }

        .activity-one {
            background-color: rgb(124, 136, 224, 0.5);
            background-image: linear-gradient(240deg, rgb(124, 136, 224) 0%, #c3f4fc 100%);
        }

        .activity-two {
            background-color: #aee2a4a1;
            background-image: linear-gradient(240deg, #e5a243ab 0%, #f7f7aa 90%);
        }

        .activity-three {
            background-color: #ecfcc376;
            background-image: linear-gradient(240deg, #97e7d1 0%, #ecfcc3 100%);
        }

        .activity-four {
            background-color: #e6a7c3b5;
            background-image: linear-gradient(240deg, #fc8ebe 0%, #fce5c3 100%);
        }

        .day {
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: translateY(-10px);
        }

        .day h1 {
            font-size: 1.6rem;
            font-weight: 600;
        }

        .day p {
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: 600;
            transform: translateY(-3px);
        }

        .activity {
            border-left: 3px solid #484d53;
        }

        .participants {
            display: flex;
            margin-left: 20px;
        }

        .participants img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            z-index: calc(2 * var(--i));
            margin-left: -10px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 3px;
        }

        .activity > h2 {
            margin-left: 10px;
            font-size: 1.25rem;
            font-weight: 600;
            border-radius: 12px;
        }

        /* CSS per i corsi di allenamento */
        .courses {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .course {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        /* CSS per il pulsante di cambio visualizzazione */
        .switch-button {
            margin-top: 10px;
            text-align: center;
        }

        /* CSS per le chat */
        .chat-list {
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
        }

        .chat-message {
            display: none;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .active-chat {
            display: block;
            border-left: 3px solid #4caf50;
            background-color: #f0f0f0;
        }
/*PROFILO*/
        .profile-picture {
            padding: 2%;
            left: 0;
            position: absolute;
        }

        .profile-picture > label {
            margin-top: 200px;
            margin-right: 10px; /* Margine a destra per separare l'etichetta dall'input */
        }


        /* Stile per l'immagine del profilo */
        .profile-image {
            width: 350px; /* Dimensioni dell'immagine del profilo */
            height: 350px;
            border-radius: 50%; /* Bordo circolare */
            object-fit: cover; /* Per adattare l'immagine alla dimensione specificata */
        }
        .profile-image-preview {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            position: absolute;
            margin-top: 30px;
            margin-left: 70px;
        }

        .profile-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Stile per le informazioni del profilo */
        .profile-details {
            padding: 2%;
            right: 0;
            top: 0;
            position: absolute;
        }
    </style>
</head>
<body>
    <!--Header, there is the navbar menu and login-->
    <header id="beginning"> 
        <nav class="nav responsive">
            <!--container for logo and name-->
            <ul class="logo container"> 
                <li>
                    <img class="logo_img" src="immagini/logo/Ade.jpg">
                </li>
                <li>
                    <a class="logo_name">ADE Sporting Club</a>                
                </li>
            </ul>
            <!--container for navbar, topBotomBordersOut is the name of the toolbar animation-->
            <ul class="toolbar container topBotomBordersOut"> 
                <li>
                    <a class="toolbar_link_Home" href="index.html">Home</a>
                </li>
                <li>
                    <a class="toolbar_link_Struttura" href="Struttura.html">Struttura</a>
                </li>
                <li>
                    <a class="toolbar_link_Attivita" href="Attivita.html"> Attività</a>
                </li>             
                <li>
                    <a class="toolbar_link_Prenota" href="Prenota.html">Prenota</a>
                </li>
                <li>
                    <a class="toolbar_link_Soci" href="Soci.html">Soci</a> 
                </li>
            </ul>

            <!--container for login features--> <!--Inserire un link sign in, sign up e un bottone con l'immagine che se cliccato ti apre un menu con accedi e registrati-->
            <div class="person flex">
                <ul class="login_menu">
                    <!-- POPUP DEL LOGIN -->
                    <li><button id="mostraPopupButton">Accedi</button></li>
                    <li><a href="login_registrazione/registration.php"><button>Registrati</button></a></li>
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
                    <input type="file" id="profile-image" accept="image/*" onchange="previewProfileImage(event)">
                </div>
                <!-- dettagli utente -->
                <div class="profile-details">
                    <p><strong>Nome:</strong> <?php echo $nome; ?></p>
                    <p><strong>Cognome:</strong> <?php echo $cognome; ?></p>
                    <p><strong>Data di nascita:</strong> <?php echo $data_di_nascita; ?></p>
                    <p><strong>Tipo di abbonamento:</strong> <?php echo $tipo_abbonamento; ?></p>
                    <p><strong>Data sottoscrizione abbonamento:</strong> <?php echo $data_sottoscrizione_abbonamento; ?></p>
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
