<?php
    session_start();

    $logged=isset($_SESSION['logged_in']);
    $gold=isset($_SESSION['gold']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- serve per inserire un'icona nel title. Ho generato l'icona dal sito https://www.favicon-generator.org/ -->
    <link rel="icon" type="image/png" sizes="32x32" href="immagini/logo/favicon2.png">
    <title>Ade Sporting Club</title>

    <!--Link to style folder-->
    <link rel="StyleSheet" href="Style/utility.css">
    <link rel="StyleSheet" href="Style/navbar.css">
    <link rel="StyleSheet" href="Style/login.css">
    <link rel="StyleSheet" href="Style/footer.css">
    <link rel="StyleSheet" href="Style/index.css">
    <link rel="StyleSheet" href="Style/gallery.css">
    <link rel="stylesheet" href="Style/popup.css">
    <link rel="stylesheet" href="Style/prenota.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- per le cione delle attivita -->

    <!-- Link ai file javascript -->
    <script src="js/login.js" defer></script>
    <script src="js/navbar.js" defer></script>
    <script src="js/prenotazioni.js" defer></script>

    <!--Script javascript-->
    <script>
        // Funzione per controllare se l'utente è loggato prima di consentire il clic
        function checkLogin() {
            var loggedIn = <?php echo isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'true' : 'false'; ?>;
            if (!loggedIn) {
                // Se l'utente non è loggato, mostra il messaggio di avviso
                alert("Devi effettuare l'accesso per visualizzare questa sezione.");
                return false; // Impedisce l'azione predefinita del clic
            }
        }
    </script>
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
                    <a class="toolbar_link_Home" href="index.php">Home</a>
                </li>
                <li>
                    <a class="toolbar_link_Struttura" href="Struttura.php">Struttura</a>
                </li>
                <li>
                    <a class="toolbar_link_Attivita" href="Attivita.php"> Attività</a>
                </li>               
                <li>
                    <a class="toolbar_link_Prenota" href="Prenota.php">Prenota</a>
                </li>
            </ul>
            <div class="login_btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                </svg>
            </div>
            <!--container for login features--> 
            <?php if(!$logged) :?>
                <div class="person flex">
                    <ul class="login_menu">
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
                        <!-- POPUP DEL LOGIN -->
                        <li>
                            <button class="Sign in" id="mostraPopupButton">Accedi</button>
                        </li>

                    </ul>
                </div>
            <?php else: ?>
                <div class="person flex">
                    <ul class="login_menu">
                        <!-- rimanda al profilo personale -->
                        <?php if(!$gold): ?>
                            <a href="login_registrazione/utenteNonGold.php">
                                <button class="Sign profile">Profilo</button>
                            </a>
                        <?php else: ?>
                            <a href="login_registrazione/utenteGold.php">
                                <button class="Sign profile">Profilo</button>
                            </a>
                        <?php endif;?>
                        <!-- Logout -->
                        <form action="php/logout.php" method="post" >
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

    <!-- Div nascosto del popup -->
    <div id="popup" class="popup">
        <iframe src="login_registrazione/login.php" width="580" height="500" frameborder="0" style="border:0; overflow:hidden;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="zona">
    <table>
        <tr>
            <th class="time-column">Ora\Giorno</th>
            <th>Lunedì</th>
            <th>Martedì</th>
            <th>Mercoledì</th>
            <th>Giovedì</th>
            <th>Venerdì</th>
            <th>Sabato</th>
            <th>Domenica</th>
        </tr>
        <?php
            // Connessione al database PostgreSQL
            $conn = pg_connect("host=localhost dbname=Ade_Sporting_Club user=postgres password=Sporting77!");
            if (!$conn) {
                echo "Errore nella connessione al database.";
                exit;
            }

            // Query per recuperare i dati dalla tabella Prenotazioni
            $result = pg_query($conn, "SELECT * FROM prenotazione"); //prenotazione

            if ($result) {
                // Array associativo per memorizzare le prenotazioni per ogni orario
                $prenotazioni_per_orario = array(
                    "10:00 - 11:00" => array(),
                    "11:00 - 12:00" => array(),
                    "12:00 - 13:00" => array(),
                    "13:00 - 14:00" => array(),
                    "14:00 - 15:00" => array(),
                    "15:00 - 16:00" => array(),
                    "16:00 - 17:00" => array(),
                    "17:00 - 18:00" => array(),
                    "18:00 - 19:00" => array(),
                    "19:00 - 20:00" => array(),
                    "20:00 - 21:00" => array(),
                    "21:00 - 22:00" => array(),
                );

                // Riempimento dell'array con i dati delle prenotazioni
                while ($row = pg_fetch_assoc($result)) {
                    $id = $row["id"];
                    $giorno = $row["giorno"];
                    $inizio_completo = $row["orario_inizio"];
                    $fine_completo = $row["orario_fine"];
                    $sport = $row["sport"];
                    $completa = $row["completa"];

                    $inizio = substr($inizio_completo, 0, 5); // Estrae solo i primi 5 caratteri (HH:MM)
                    $fine = substr($fine_completo, 0, 5); // Estrae solo i primi 5 caratteri (HH:MM)

                    // Costruzione della stringa per l'orario
                    $orario = "$inizio - $fine";

                    // Aggiunta della prenotazione all'array associativo
                    $prenotazioni_per_orario[$orario][$giorno][] = array("id" => $id, "sport" => $sport, "completa" => $completa);
                }

                // Creazione della tabella HTML
                foreach ($prenotazioni_per_orario as $orario => $prenotazioni_per_giorno) {
                    echo "<tr>";
                    echo "<td>$orario</td>";
                    foreach (["lunedi", "martedi", "mercoledi", "giovedi", "venerdi", "sabato", "domenica"] as $giorno) {
                        echo "<td>";
                        if (isset($prenotazioni_per_giorno[$giorno])) {                            
                            echo "<table class='inner-table'>";

                            // Creazione di una cella per ogni prenotazione
                            foreach ($prenotazioni_per_giorno[$giorno] as $prenotazione) {
                                $id = $prenotazione["id"];
                                $sport = $prenotazione["sport"];
                                $completa = $prenotazione["completa"];

                                // Determina l'icona corretta per lo sport
                                $icona = "";
                                switch ($sport) {
                                    case "calcio":
                                        $icona = "fas fa-futbol"; // Icona per calcio
                                        break;
                                    case "paddle":
                                        $icona = "fas fa-table-tennis"; // Icona per paddle
                                        break;
                                    case "tennis":
                                        $icona = "fas fa-baseball-ball"; // Icona per tennis
                                        break;
                                    case "nuoto":
                                        $icona = "fas fa-swimmer"; // Icona per nuoto
                                        break;
                                    case "basket":
                                        $icona = "fas fa-basketball-ball"; // Icona per basket
                                        break;
                                    default:
                                        $icona = "fas fa-question"; // Icona generica
                                        break;
                                }

                                // Determina il colore dello sfondo in base alla prenotazione completa o incompleta
                                $sfondo = $completa == 't' ? "#99d98c" : "#ffc300"; // Sfondo verde se completa, rosso altrimenti

                                // Costruzione del testo del tooltip
                                $tooltip = "ID: $id\nSport: $sport\n";
                                if ($completa == 't') {
                                    $tooltip .= "Campo: 1\nStato: Completa";
                                } else {
                                    // Supponendo che il numero di persone sia memorizzato in un'altra tabella
                                    // Possiamo sostituire questo valore con quello appropriato
                                    $numero_persone = 4; // Da sostituire con il numero reale di persone
                                    $tooltip .= "Campo: 1\nNumero Persone: $numero_persone";
                                }

                                // Aggiungi l'icona con il tooltip
                                echo "<td style='background-color: $sfondo' title='$tooltip'><i class='$icona'></i></td>";              
                            }
                            echo "</table>";
                        }

                        echo "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "Nessuna prenotazione trovata.";
            }
        ?>
        </table>
    </div>

    <div class="zona">
        <p>la tebella sovrastante riporta le disponibilita dei vari campi da gioco. se la prenotazione è in verde vuol dire che il campo è già preso. se la prenotazione c'è ma risulta ancora rossa vuol dire che non è completa ci si può aggiungere</p>
    </div>

    <!-- io inserirei a destra di ogni tendina un post it con le informazioni relative ai costi dei campi -->
    <div>
        <ul class="toggle-list" >
            <li class="toggle-item" onclick="return checkLogin();">
                <input type="radio" id="calcio" name="attivita">
                <label for="calcio" >Calcetto<span class="arrow" ></span></label>
                <div class="content">
                    <form action="php/checkLogin.php" method="post" >
                        <label for="dataCalcio">Data:</label>
                        <input type="date" id="dataCalcio" name="dataCalcio"><br>
                        <label for="orario">Orario prenotazione:</label>
                        <select class="orario" name="ora" required>
                            <option value="">Seleziona un orario</option>
                        </select><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="calcetto_1">Campo 1</option>
                            <option value="calcetto_2">Campo 2</option>
                            <option value="calcetto_3">Campo 3</option>
                        </select><br>
                        <label for="prenotazione">Tipo di prenotazione:</label><br>
                        <input type="radio" id="interoCampo" name="prenotazione" value="interoCampo" required>
                        <label for="interoCampo">Prenotazione dell'intero campo</label><br>
                        <input type="radio" id="codaGioco" name="prenotazione" value="codaGioco">
                        <label for="codaGioco">Aggiungi alla coda di gioco</label><br>
                        <div id="numPersoneWrapper">
                            <label for="numeroPersone">Numero di persone:</label>
                            <input type="number" id="numeroPersone" name="numeroPersone" min="1" required><br>
                        </div>
                        
                        <input type="submit" value="Prenota"> <!-- qua verifichiamo se l'utente ha fatto il login e poi magari mandiamo una mail di conferma con la ricevuta della prenotazione -->
                        <input type="reset" value="Azzera i campi">
                    </form>
                </div>
            </li>
            <li class="toggle-item" onclick="return checkLogin();">
                <input type="radio" id="paddle" name="attivita">
                <label for="paddle">Paddle<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="php/prenotazione.php">
                        <label for="dataPaddle">Data:</label>
                        <input type="date" id="dataPaddle" name="dataPaddle"><br>
                        <label for="orario">Orario prenotazione:</label>
                        <select class="orario" name="ora" required>
                            <option value="">Seleziona un orario</option>
                        </select><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="paddle_1">Campo 1</option>
                            <option value="paddle_2">Campo 2</option>
                            <option value="paddle_3">Campo 3</option>
                            <option value="paddle_3">Campo 4</option>
                        </select><br>
                        <label for="prenotazione">Tipo di prenotazione:</label><br>
                        <input type="radio" id="interoCampo" name="prenotazione" value="interoCampo" required>
                        <label for="interoCampo">Prenotazione dell'intero campo</label><br>
                        <input type="radio" id="codaGioco" name="prenotazione" value="codaGioco">
                        <label for="codaGioco">Aggiungi alla coda di gioco</label><br>
                        <div id="numPersoneWrapper">
                            <label for="numeroPersone">Numero di persone:</label>
                            <input type="number" id="numeroPersone" name="numeroPersone" min="1" required><br>
                        </div>
                        
                        <input type="submit" value="Prenota"> <!-- qua verifichiamo se l'utente ha fatto il login e poi magari mandiamo una mail di conferma con la ricevuta della prenotazione -->
                        <input type="reset" value="Azzera i campi">
                    </form>
                </div>
            </li>
            <li class="toggle-item" onclick="return checkLogin();">
                <input type="radio" id="tennis" name="attivita">
                <label for="tennis">Tennis<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="php/prenotazione.php">
                        <label for="dataTennis">Data:</label>
                        <input type="date" id="dataTennis" name="dataTennis"><br>
                        <label for="orario">Orario prenotazione:</label>
                        <<select class="orario" name="ora" required>
                            <option value="">Seleziona un orario</option>
                        </select><br>
                        <label for="sceltacampo">Tipo di prenotazione:</label><br>
                        <input type="radio" id="terra" name="sceltacampo" value="terra" required>
                        <label for="terra">Campo in terra</label><br>
                        <input type="radio" id="cemento" name="sceltacampo" value="cemento">
                        <label for="cemento">Campo in cemento</label><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="tennis_1">Campo 1</option>
                            <option value="tennis_2">Campo 2</option>
                            <option value="tennis_3">Campo 3</option>
                            <option value="tennis_4">Campo 4</option> <!-- con js fai il controllo, i primi due so di terra e gli altri due in cemento -->
                        </select><br>
                        <label for="prenotazione">Tipo di prenotazione:</label><br>
                        <input type="radio" id="interoCampo" name="prenotazione" value="interoCampo" required>
                        <label for="interoCampo">Prenotazione dell'intero campo</label><br>
                        <input type="radio" id="codaGioco" name="prenotazione" value="codaGioco">
                        <label for="codaGioco">Aggiungi alla coda di gioco</label><br>
                        <div id="numPersoneWrapper">
                            <label for="numeroPersone">Numero di persone:</label>
                            <input type="number" id="numeroPersone" name="numeroPersone" min="1" required><br>
                        </div>
                        
                        <input type="submit" value="Prenota"> <!-- qua verifichiamo se l'utente ha fatto il login e poi magari mandiamo una mail di conferma con la ricevuta della prenotazione -->
                        <input type="reset" value="Azzera i campi">
                    </form>
                </div>
            </li>
            <li class="toggle-item" onclick="return checkLogin();">
                <input type="radio" id="basket" name="attivita">
                <label for="basket">Basket<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="php/prenotazione.php">
                        <label for="dataBasket">Data:</label>
                        <input type="date" id="dataBasket" name="dataBasket"><br>
                        <label for="orario">Orario prenotazione:</label>
                        <select class="orario" name="ora" required>
                            <option value="">Seleziona un orario</option>
                        </select><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="campo1">Basket_1</option>
                            <option value="campo2">Basket_2</option>
                        </select><br>
                        <label for="prenotazione">Tipo di prenotazione:</label><br>
                        <input type="radio" id="interoCampo" name="prenotazione" value="interoCampo" required>
                        <label for="interoCampo">Prenotazione dell'intero campo</label><br>
                        <input type="radio" id="codaGioco" name="prenotazione" value="codaGioco">
                        <label for="codaGioco">Aggiungi alla coda di gioco</label><br>
                        <div id="numPersoneWrapper">
                            <label for="numeroPersone">Numero di persone:</label>
                            <input type="number" id="numeroPersone" name="numeroPersone" min="1" required><br>
                        </div>
                        
                        <input type="submit" value="Prenota"> <!-- qua verifichiamo se l'utente ha fatto il login e poi magari mandiamo una mail di conferma con la ricevuta della prenotazione -->
                        <input type="reset" value="Azzera i campi">
                    </form>
                </div>
            </li>
            <li class="toggle-item" onclick="return checkLogin();">
                <input type="radio" id="nuoto" name="attivita">
                <label for="nuoto">Nuoto<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="php/prenotazione.php">
                        <label for="dataNuoto">Data:</label>
                        <input type="date" id="dataNuoto" name="dataNuoto"><br>
                        <!-- se possibile mettiamo in elenco solo le fasce disponibili -->
                        <label for="orarioNuoto">Scegli una fascia oraria:</label>
                        <select name="type" id="orarioNuoto"  required>
                            <option value="">Seleziona orario</option>
                            <option value="1">9:00 - 10:00</option>
                            <option value="2">10:00 - 11:00</option>
                            <option value="3">11:00 - 12:00</option>
                            <option value="4">12:00 - 13:00</option>
                        </select><br>
                        <input type="submit" value="Prenota"> 
                        <input type="reset" value="Azzera i campi">
                    </form>
                </div>
            </li>
            <li class="toggle-item" onclick="return checkLogin();">
                <input type="radio" id="palestra" name="attivita">
                <label for="palestra">Palestra<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="php/prenotazione.php">
                        <label for="dataPalestra">Data:</label>
                        <input type="date" id="dataPalestra" name="dataPalestra"><br>
                        <!-- se possibile mettiamo in elenco solo le fasce disponibili -->
                        <label for="orarioPalestra">Scegli una fascia oraria:</label>
                        <select class="orario" name="ora" required>
                            <option value="">Seleziona un orario</option>
                        </select><br>
                        <input type="submit" value="Prenota"> 
                        <input type="reset" value="Azzera i campi">
                    </form>
                </div>
            </li>
        </ul>
    </div>

<!-- Footer section with contacts -->	
    <footer>
        <div class="map">
            <h3>Dove siamo</h3>
            <!-- Embedding a Google Map -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2967.235657742299!2d12.57007927646197!3d41.952273060766345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f64619ddc961d%3A0x997b053d9ac9f023!2sSporting%20Club%20Panda!5e0!3m2!1sit!2sit!4v1714034933636!5m2!1sit!2sit" width="400" height="250" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="contacts">
            <h2>Contact Us</h2>
            <p>Email: example@example.com</p>
            <p>Phone: +1234567890</p>

            <!-- Copyright Information -->
            <p>&copy; 2024 Sample Website. All Rights Reserved.</p>

            <!-- Social Media Links -->
            <div>
                <a href="https://www.facebook.com">Facebook</a>
                <a href="https://twitter.com">Twitter</a>
                <a href="https://www.instagram.com">Instagram</a>
            </div>
        </div>
        <div class="ancora">
            <a href="#beginning">torna su</a>		<!-- ancora per tornare all'inizio della pagina -->
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ottieni tutti gli elementi con la classe "orario"
            var selectOrari = document.querySelectorAll(".orario");

            // Per ogni elemento, popola la lista degli orari con i valori appropriati
            selectOrari.forEach(function(selectOrario) {
                for (var hour = 8; hour < 22; hour++) {
                    for (var minute = 0; minute < 60; minute += 15) { // Solo minuti multipli di 15
                        if (minute === 0) { // Solo minuti uguali a 00
                            var formattedHour = ('0' + hour).slice(-2);
                            selectOrario.innerHTML += '<option value="' + formattedHour + ':00">' + formattedHour + ':00</option>';
                        }
                    }
                }
            });
        });
    </script>

    <script>
        // Ottieni tutti gli input di tipo date
        var inputDateFields = document.querySelectorAll("input[type='date']");

        // Ottieni la data corrente
        var now = new Date();
        // Imposta la data minima come la data corrente (nel formato richiesto dall'input di tipo date)
        // Aggiungi un giorno per permettere solo date future
        var minDate = new Date(now.getTime() + 24 * 60 * 60 * 1000).toISOString().split('T')[0];

        // Itera su ogni campo data e imposta la data minima
        inputDateFields.forEach(function(inputData) {
            inputData.min = minDate;
        });
    </script>
</body>
</html>