<?php
    session_start();
    $_SESSION['url']=$_SERVER['REQUEST_URI'];
    $logged=isset($_SESSION['logged_in']);
    $gold=isset($_SESSION['gold']);
    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
    }

    if(isset($_SESSION['message'])){
        echo "<p class='errore'  id='messaggiAlto'>" . htmlspecialchars($_SESSION['message']) . "</p>";
        unset($_SESSION['message']);
    }
    if(isset($_SESSION['conferma'])){
        echo "<p class='conferma'  id='messaggiAlto'>" . htmlspecialchars($_SESSION['conferma']) . "</p>";
        unset($_SESSION['conferma']);
    }
    if(isset($_SESSION['credenziali'])){
        echo "<p class='errore' id='messaggiAlto'>" . htmlspecialchars($_SESSION['credenziali']) . "</p>";
        unset($_SESSION['credenziali']);
    }
    include_once "php/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- It is used to insert an icon in the title. I generated the icon from the site https://www.favicon-generator.org/ -->
    <link rel="icon" type="image/png" sizes="32x32" href="immagini/logo/favicon2.png">
    <title>Ade Sporting Club</title>

    <!--Link to style folder-->
    <link rel="StyleSheet" href="Style/modal.css">
    <link rel="StyleSheet" href="Style/scorrimentoAlto.css">
    <link rel="StyleSheet" href="Style/utility.css">
    <link rel="StyleSheet" href="Style/navbar.css">
    <link rel="StyleSheet" href="Style/footer.css">
    <link rel="stylesheet" href="Style/popup.css">
    <link rel="stylesheet" href="Style/prenota.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!--for activity icons-->

    <!-- Link ai file javascript -->
    <script src="js/login.js" defer></script>
    <script src="js/navbar.js" defer></script>
    <script src="js/prenotazioni.js" defer></script>
    <script src="js/messaggi.js" defer></script>

    <!--Script javascript-->
    <script>
        // Function to check if the user is logged in before allowing the click
        function checkLogin() {
            var loggedIn = <?php echo isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'true' : 'false'; ?>;
            if (!loggedIn) {
                // If the user is not logged in, show the warning message
                alert("Devi effettuare l'accesso per visualizzare questa sezione.");
                return false; // Prevents the default click action
            } else {
                return true;
            }
        }
    </script>
</head>

<body>
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
            <div class="linksito">
                <div class="login_btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" >
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 
                        16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 
                        1-.437-.695Z" clip-rule="evenodd" />
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
                            <li>
                                <button class="Sign in" id="mostraPopupButton">Accedi</button>
                            </li>
                        </ul>
                    </div>
                    
                <?php else: ?>
                    <div class="person flex">
                        <ul class="login_menu">
                            <!--refers to your personal profile-->
                            <?php if($id < 30): ?>
                                <a href="login_registrazione/Istruttore.php">
                                    <button class="Sign profile">Profilo</button>
                                </a>
                            <?php elseif($id >= 30 && !$gold): ?>
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
                nav = document.querySelector('.person');

                show_menu.onclick = () => {
                    nav.classList.toggle("show");
                };
            </script>
            <!-- end javascript -->

            <!-- navbar for small screen -->
            <div class="hamburger_menu" onclick=showSidebar()>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 
                        6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 
                        0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
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
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="Struttura.php">Struttura</a>
                </li>
                <li>
                    <a href="Attivita.php"> Attività</a>
                </li>               
                <li>
                    <a href="Prenota.php">Prenota</a>
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
            </script>
            <!-- end javascript -->


            <!--sticky navbar on scroll-->
            <script type="text/javascript">
                window.addEventListener("scroll", function(){
                    var header = document.querySelector("header");
                    header.classList.toggle("sticky", window.scrollY > 0);
                });
            </script>
            <!-- end javascript --> 
        </nav>
    </header>

    <!-- Overlay div -->
    <div id="overlay" class="overlay"></div>
    <!--Hidden popup div-->
    <div id="popup" class="popup">
        <iframe src="login_registrazione/login.php" frameborder="0" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <main>
        <div class="zona">
        <table>
            <?php 
                date_default_timezone_set('Europe/Rome');  // Construction of the array for the days of the week "DayWeek -date"
                $mondayOfThisWeek = date('Y-m-d', strtotime('monday this week'));  // Get this week's Monday date
                $daysOfTheWeek = array(); // Initializes an array to store the days of the current week
                for ($i = 0; $i < 7; $i++) {
                    $day = date('Y-m-d', strtotime($mondayOfThisWeek . " +$i days")); // Add days to the date from Monday
                    $daysOfTheWeek[] = $day;
                }
            ?>
            <tr>
                <!-- Creating header line in the following format "Day Y-M-D"-->
                <th class="time-column">Ora\Giorno</th>
                <th>Lunedì <?php echo $daysOfTheWeek[0]?></th>
                <th>Martedì <?php echo $daysOfTheWeek[1]?></th>
                <th>Mercoledì <?php echo $daysOfTheWeek[2]?></th>
                <th>Giovedì <?php echo $daysOfTheWeek[3]?></th>
                <th>Venerdì <?php echo $daysOfTheWeek[4]?></th>
                <th>Sabato <?php echo $daysOfTheWeek[5]?></th>
                <th>Domenica <?php echo $daysOfTheWeek[6]?></th>
            </tr>
            <?php
                // Query to retrieve data from the table Prenotazione
                $result = pg_query($conn, "SELECT * FROM prenotazione p join campo c on c.id = p.campo WHERE owner='true'"); 
                if ($result) {
                    // Associative array to store reservations for each time
                    $prenotazioni_per_orario = array(
                        "08:00 - 09:00" => array(),
                        "09:00 - 10:00" => array(),
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
                        "22:00 - 23:00" => array(),
                    );

                    // Filling the array with booking data
                    while ($row = pg_fetch_assoc($result)) {            
                        $id_prenotazione = $row["id_prenotazione"];
                        $data = $row["data"];
                        $campo =$row["campo"];
                        // Take the day of the week
                        $giornoSettimana=date('l', strtotime($data));
                        $giorno = "$giornoSettimana - $data";
                        $inizio_completo = $row["ora_inizio"];
                        $fine_completo = $row["ora_fine"];
                        $utente = $row["utente"];
                        $completa = $row["completa"];
                        $num_persone = $row["num_persone"];

                        $sport = $row["tipo"];

                        $inizio = substr($inizio_completo, 0, 5); // Extracts only the first 5 characters (HH:MM)
                        $fine = substr($fine_completo, 0, 5); 
                        
                        // Construction of the time string
                        $orario = "$inizio - $fine"; 
                        // Adding the reservation to the associative array
                        $prenotazioni_per_orario[$orario][$giorno][] = array("id" => $id_prenotazione,"numero_campo" => $campo, "sport" => $sport, "completa" => $completa, "persone" => $num_persone);
                    }
                    
                    // Creation of the HTML table
                    foreach ($prenotazioni_per_orario as $orario => $prenotazioni_per_giorno) {
                        echo "<tr>";
                        echo "<td>$orario</td>";
                        foreach (["Monday - " . $daysOfTheWeek[0], "Tuesday - ". $daysOfTheWeek[1], "Wednesday - ". $daysOfTheWeek[2], "Thursday - ". $daysOfTheWeek[3], "Friday - ". $daysOfTheWeek[4], "Saturday - ". $daysOfTheWeek[5], "Sunday - ". $daysOfTheWeek[6]] as $giorno) {
                            
                            echo "<td>";
                            if (isset($prenotazioni_per_giorno[$giorno])) {                            
                                echo "<table class='inner-table'>";

                                // Creating a cell for each booking
                                foreach ($prenotazioni_per_giorno[$giorno] as $prenotazione) {
                                    $id = $prenotazione["id"];
                                    $sport = $prenotazione["sport"];
                                    $campo= $prenotazione["numero_campo"];
                                    $completa = $prenotazione["completa"];
                                    $persone = $prenotazione["persone"];

                                    // Determine the correct icon for the sport
                                    $icona = "";
                                    switch ($sport) {
                                        case "Calcetto":
                                            $icona = "fas fa-futbol"; 
                                            break;
                                        case "Paddle":
                                            $icona = "fas fa-table-tennis"; 
                                            break;
                                        case "Tennis":
                                            $icona = "fas fa-baseball-ball"; 
                                            break;
                                        case "Nuoto":
                                            $icona = "fas fa-swimmer"; 
                                            break;
                                        case "Basket":
                                            $icona = "fas fa-basketball-ball"; 
                                            break;
                                        case "Palestra":
                                            $icona ="fa-solid fa-dumbbell";
                                            break;
                                        case "Piscina":
                                            $icona ="fa-solid fa-person-swimming";
                                            break;
                                        default:
                                            $icona = "fas fa-question";
                                            break;
                                    }
                                    // Construction of the tooltip text
                                    $tooltip = "ID: $id\nCampo: $campo\nSport: $sport\n";
                                    if ($completa == 't') {
                                        $tooltip .= "Stato: Completa";
                                    } else {
                                        $tooltip .= "Numero Persone: $persone";
                                    }
                                    //Add the icon with the tooltip with a green background if the reservation is complete, otherwise with a yellow background
                                    if($completa == 't'){
                                        $sfondo = "#99d98c";                                        
                                        echo "<td style='background-color: $sfondo; ' title='$tooltip'><i class='$icona'></i></td>";
                                    }else{
                                        $sfondo = "#ffc300";
                                        echo "<td style='background-color: $sfondo; cursor: pointer;' title='$tooltip' onclick='if(checkLogin()) {finestraDiAggiunta($id)}'><i class='$icona'></i></td>";
                                    }

                                                
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

            <!-- Modal Window -->
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div id="modalContent">
                        <!-- The booking details will be dynamically inserted here -->
                    </div>
                    <button id="actionButton">Aggiungimi alla prenotazione</button>
                </div>
            </div>
        </div>

        <div class="zona">
            <h2>Prenota un campo</h2>
            <p>La tabella sovrastante riporta le disponibilita settimanali (lun-dom) dei vari campi da gioco. Seleziona un'attività e un campo per prenotare un'ora di gioco.<br> 
            <br>Se la prenotazione risulta verde vuol dire che è stata validata e tale campo è quindi occupato. Al contrario se la prenotazione c'è ma risulta ancora gialla vuol dire che non è completa e ci si può aggiungere.
            <br>Per aggiungersi ad una prenotazione basta cliccare sulla cella gialla e verrà aperta una finestra modale per la prenotazione.</p>
        </div>
        <div>
            <ul class="toggle-list" >
                <!-- in each activity we have made only the available time slots and days clickable -->
                <li id="prenota_calcio" class="toggle-item" onclick="return checkLogin();">
                    <input type="radio" id="calcio" name="attivita">
                    <label for="calcio" >Calcetto<span class="arrow" ></span></label>
                    <div class="content">
                        <form action="php/prenotazione.php" method="post" name="formPrenotazione" onsubmit="return checkNumGiocatori(this)">
                            <label for="dataCalcio">Data:</label>
                            <input type="date" id="dataCalcio" name="data" required><br>
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
                            <div class="numPersoneWrapper">
                                <label for="numeroPersone">Numero di persone:</label>
                                <input type="number" id="numeroPersone" name="numeroPersone" min="1" max="9"><br>
                            </div>
                            
                            <input type="submit" value="Prenota" > 
                            <input type="reset" value="Azzera i campi">
                        </form>
                    </div>
                </li>
                <li id="prenota_paddle" class="toggle-item" onclick="return checkLogin();">
                    <input type="radio" id="paddle" name="attivita">
                    <label for="paddle">Paddle<span class="arrow"></span></label>
                    <div class="content">
                        <form method="post" action="php/prenotazione.php" name="formPrenotazione" onsubmit="return checkNumGiocatori(this)">
                            <label for="dataPaddle">Data:</label>
                            <input type="date" id="dataPaddle" name="data" required><br>
                            <label for="orario">Orario prenotazione:</label>
                            <select class="orario" name="ora" required>
                                <option value="">Seleziona un orario</option>
                            </select><br>
                            <label for="campo">Seleziona campo:</label><br>
                            <select id="campo" name="campo" required>
                                <option value="paddle_4">Campo 1</option>
                                <option value="paddle_5">Campo 2</option>
                                <option value="paddle_6">Campo 3</option>
                            </select><br>
                            <label for="prenotazione">Tipo di prenotazione:</label><br>
                            <input type="radio" id="interoCampo" name="prenotazione" value="interoCampo" required>
                            <label for="interoCampo">Prenotazione dell'intero campo</label><br>
                            <input type="radio" id="codaGioco" name="prenotazione" value="codaGioco">
                            <label for="codaGioco">Aggiungi alla coda di gioco</label><br>
                            <div class="numPersoneWrapper">
                                <label for="numeroPersone">Numero di persone:</label>
                                <input type="number" id="numeroPersone" name="numeroPersone" min="1" max="3"><br>
                            </div>
                            
                            <input type="submit" value="Prenota"> 
                            <input type="reset" value="Azzera i campi">
                        </form>
                    </div>
                </li>
                <li id="prenota_tennis" class="toggle-item" onclick="return checkLogin();">
                    <input type="radio" id="tennis" name="attivita">
                    <label for="tennis">Tennis<span class="arrow"></span></label>
                    <div class="content">
                        <form method="post" action="php/prenotazione.php" name="formPrenotazione" onsubmit="return checkNumGiocatori(this)">
                            <label for="dataTennis">Data:</label>
                            <input type="date" id="dataTennis" name="data" required><br>
                            <label for="orario">Orario prenotazione:</label>
                            <select class="orario" name="ora" required>
                                <option value="">Seleziona un orario</option>
                            </select><br>
                            <select id="campo" name="campo" required>
                                <option value="tennis_7">Campo 1</option>
                                <option value="tennis_8">Campo 2</option>
                                <option value="tennis_9">Campo 3</option>
                                <option value="tennis_10">Campo 4</option> 
                            </select><br>
                            <label for="prenotazione">Tipo di prenotazione:</label><br>
                            <input type="radio" id="interoCampo" name="prenotazione" value="interoCampo" required>
                            <label for="interoCampo">Prenotazione dell'intero campo</label><br>
                            <input type="radio" id="codaGioco" name="prenotazione" value="codaGioco">
                            <label for="codaGioco">Aggiungi alla coda di gioco</label><br>
                            <div class="numPersoneWrapper">
                                <label for="numeroPersone">Numero di persone:</label>
                                <input type="number" id="numeroPersone" name="numeroPersone" min="1" max="1"><br>
                            </div>
                            
                            <input type="submit" value="Prenota"> 
                            <input type="reset" value="Azzera i campi">
                        </form>
                    </div>
                </li>
                <li id="prenota_basket" class="toggle-item" onclick="return checkLogin();">
                    <input type="radio" id="basket" name="attivita">
                    <label for="basket">Basket<span class="arrow"></span></label>
                    <div class="content">
                        <form method="post" action="php/prenotazione.php" name="formPrenotazione" onsubmit="return checkNumGiocatori(this)">
                            <label for="dataBasket">Data:</label>
                            <input type="date" id="dataBasket" name="data" required><br>
                            <label for="orario">Orario prenotazione:</label>
                            <select class="orario" name="ora" required>
                                <option value="">Seleziona un orario</option>
                            </select><br>
                            <label for="campo">Seleziona campo:</label><br>
                            <select id="campo" name="campo" required>
                                <option value="basket_11">Campo_1</option>
                                <option value="basket_12">Campo_2</option>
                            </select><br>
                            <label for="prenotazione">Tipo di prenotazione:</label><br>
                            <input type="radio" id="interoCampo" name="prenotazione" value="interoCampo" required>
                            <label for="interoCampo">Prenotazione dell'intero campo</label><br>
                            <input type="radio" id="codaGioco" name="prenotazione" value="codaGioco">
                            <label for="codaGioco">Aggiungi alla coda di gioco</label><br>
                            <div class="numPersoneWrapper">
                                <label for="numeroPersone">Numero di persone:</label>
                                <input type="number" id="numeroPersone" name="numeroPersone" min="1" max="9"><br>
                            </div>
                            
                            <input type="submit" value="Prenota"> 
                            <input type="reset" value="Azzera i campi">
                        </form>
                    </div>
                </li>
                <li id="prenota_nuoto" class="toggle-item" onclick="return checkLogin();">
                    <input type="radio" id="nuoto" name="attivita">
                    <label for="nuoto">Nuoto<span class="arrow"></span></label>
                    <div class="content">
                        <form method="post" action="php/prenotazione.php" name="formPrenotazione">
                            <label for="dataNuoto">Data:</label>
                            <input type="date" id="dataNuoto" name="data" required><input type="checkbox" class="hidden" id="campo" name="campo" value="piscina_13" checked><br>
                            <label for="orarioNuoto">Scegli una fascia oraria:</label>
                            <select class="orario"  name="ora" required>
                                <option value="">Seleziona orario</option>
                            </select><br>

                            <input type="submit" value="Prenota"> 
                            <input type="reset" value="Azzera i campi">
                        </form>
                    </div>
                </li>
                <li id="prenota_palestra" class="toggle-item" onclick="return checkLogin();">
                    <input type="radio" id="palestra" name="attivita">
                    <label for="palestra">Palestra<span class="arrow"></span></label>
                    <div class="content">
                        <form method="post" action="php/prenotazione.php" name="formPrenotazione">
                            <label for="dataPalestra">Data:</label> 
                            <input type="date" id="dataPalestra" name="data" required><input type="checkbox" class="hidden" id="campo" name="campo" value="palestra_14" checked><br>
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
    </main>

<!-- Footer section with contacts -->	
<footer id="abcdef">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2967.235657742299!2d12.57007927646197!3d41.952273060766345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f64619ddc961d%3A0x997b053d9ac9f023!2sSporting%20Club%20Panda!5e0!3m2!1sit!2sit!4v1714034933636!5m2!1sit!2sit" width="400" height="250" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="ancora">
            <a href="#beginning"><i class="fas fa-arrow-up"></i></a>		
        </div>

        <div class="contacts">
            <h2>Contattaci</h2>
            <p>
                marino.1984826@studenti.uniroma1.it<br>
                pulsoni.1995669@studenti.uniroma1.it<br>
                ricci.1985803@studenti.uniroma1.it
            </p>
            <hr>
            <div class="formalita">
                <div class="cc">&copy; 2024 Sample Website. All Rights Reserved.</div>
                <div class="social">
                    <a href="https://github.com/Puls02/Ade_Sporting_Club"><i class="fa-brands fa-github"></i></a>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-facebook"></i>
                </div>
            </div>
        </div>      
        
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var datePickers = document.querySelectorAll("input[name='data']");
            var selectOrariList = document.querySelectorAll(".orario");

            function populateOrari(datePicker, selectOrario) {
                // Get the current time
                var now = new Date();
                var currentHour = now.getHours();
                var currentMinute = now.getMinutes();
                var today = now.toISOString().split('T')[0];

                // Function to check if a time has passed
                function isPast(hour, minute) {
                    return hour < currentHour || (hour === currentHour && minute <= currentMinute);
                }

                //Empties the <select> element
                selectOrario.innerHTML = '';

                // Populate the times list with the appropriate values
                for (var hour = 8; hour < 23; hour++) {
                    for (var minute = 0; minute < 60; minute += 15) { // Only minutes in multiples of 15
                        if (minute === 0) { // Only minutes equal to 00
                            var formattedHour = ('0' + hour).slice(-2);
                            var hourSucc = hour + 1;
                            var formattedHourSucc = ('0' + hourSucc).slice(-2);
                            var optionText = formattedHour + ':00 - ' + formattedHourSucc + ':00';

                            // Disable the option if it is past and the date is today
                            var disabled = (datePicker.value === today && isPast(hour, 0)) ? ' disabled' : '';
                            selectOrario.innerHTML += '<option value="' + formattedHour + ':00 - ' + formattedHourSucc + ':00"' + disabled + '>' + optionText + '</option>';
                        }
                    }
                }
            }

            //Populate times initially and update whenever the date changes
            datePickers.forEach(function(datePicker, index) {
                var selectOrario = selectOrariList[index];
                datePicker.addEventListener('change', function() {
                    populateOrari(datePicker, selectOrario);
                });
                populateOrari(datePicker, selectOrario);
            });
        });
    </script>


    <script>
        //Get all date type inputs
        var inputDateFields = document.querySelectorAll("input[type='date']");

        //Get the current date
        var now = new Date();
        //Set the minimum date as the current date (in the format required by the date type input)
        var minDate = new Date(now.getTime()).toISOString().split('T')[0];

        //Iterate over each date field and set the minimum date
        inputDateFields.forEach(function(inputData) {
            inputData.min = minDate;
        });
    </script>

    <script>
        //Function to show the modal window
        function finestraDiAggiunta(id) {
            //Show the modal window
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            //ajax request
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "php/modalCreation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var modalContent = document.getElementById("modalContent");
                    modalContent.innerHTML = `
                        <p>Dettagli della prenotazione:</p>
                        <p>ID della prenotazione: ${response.id}</p>
                        <p>Sport: ${response.sport}</p>
                        <p>Id del campo: ${response.campo}</p>
                        <p>Numero di persone: ${response.num_persone}</p>
                    `;
                }
            };
            xhr.send("id=" + id); //Send the booking ID as a parameter

            //Action for the button
            var button = document.getElementById("actionButton");
            button.onclick = function() {
                var xhrAddUser = new XMLHttpRequest();
                xhrAddUser.open("POST", "php/aggiuntaGiocatore.php", true);
                xhrAddUser.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhrAddUser.onreadystatechange = function () {
                    if (xhrAddUser.readyState === XMLHttpRequest.DONE && xhrAddUser.status === 200) {
                        var response = JSON.parse(xhrAddUser.responseText);
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert("Errore: " + response.message);
                        }
                    modal.style.display = "none";
                    }
                };
                xhrAddUser.send("id=" + id);
            };
        }

        //Close modal window when user clicks 'x'
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }

        //Close the modal window when the user clicks out of the window
        window.onclick = function(event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        function checkNumGiocatori(form) {
            var giocatori = form.querySelectorAll('input[name="prenotazione"]');
            var numeroPersone = form.querySelector('input[name="numeroPersone"]');

            //Check which radio button is selected
            for (var i = 0; i < giocatori.length; i++) {
                if (giocatori[i].checked && giocatori[i].value === 'codaGioco') {
                    //If 'game queue' is selected, it controls the number of players
                    if (numeroPersone.value === "" || isNaN(numeroPersone.value)) {
                        alert("Devi inserire il numero di giocatori");
                        return false; //Prevents form submission
                    }
                }
            }
            return true; //Allows the form to be submitted if everything is valid
        }
    </script> 

</body>
</html>