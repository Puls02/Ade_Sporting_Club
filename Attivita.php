<?php
    session_start();

    $logged=isset($_SESSION['logged_in']);
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
    <link rel="StyleSheet" href="Style/gallery.css">
    <link rel="stylesheet" href="Style/popup.css">
    <link rel="stylesheet" href="Style/attivita.css"> 

    <!-- Link ai file javascript -->
    <script src="js/login.js" defer></script>
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
                        <!-- Logout -->
                        <form action="php/logout.php" method="post" >
                            <button type="submit">Logout</button>
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

    <!-- vediamo se funziona, per prevenire comportamento del link -->
    <script>
        function togglePopup() {
            var popupContainer = document.getElementById('popup');
            popupContainer.style.display = popupContainer.style.display === 'none' ? 'block' : 'none';
        }
        
        window.addEventListener('message', function(event) {
            if (event.data === 'closePopup') {
                togglePopup();
            }
        });
    </script>
   
    <div class="scatola">
        <div class="activity">
            <img src="immagini/sfondo_index/calcio.png" alt="Calcio">
            <h2>Calcio</h2>
            <p>"Scopri il campo da calcio perfetto per sfidare i tuoi avversari e vivere emozionanti partite con amici e squadre.<br> Con una superficie impeccabile, dimensioni regolamentari e strutture di supporto complete, il nostro campo offre l'ambiente ideale per vivere la passione del calcio al massimo livello."</p>
            <p>Orari: <br>Bambini: Lun-Mer-Gio 16:00-18:00<br>Ragazzi: Mar-Gio-Ven 17:00-19:00</p>
            <p>Costi:<br> Lezioni singole a partire da €20. <br>Corsi a partire da €50.</p>
            <p>Istruttori: Marco - Andrea</p>
            <p>Nelle fasce libere i campi sono usufruibili su prenotazione</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/padel.png" alt="Paddel">
            <h2>Paddle</h2>
            <p>"Scopri il campo da padel, il luogo perfetto dove divertirti con amici e familiari. Con le sue dimensioni compatte e le pareti di vetro trasparenti offre un'esperienza unica di gioco, consentendo scambi veloci e coinvolgenti."</p>
            <p>Orari:<br> Lun-Ven 9:00-20:00, Sab-Dom 10:00-18:00</p>
            <p>Costi: <br>Lezioni singole a partire da €20.</p>
            <p>Istruttori: Eleonora - Claudia</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/tennis.png" alt="Tennis">
            <h2>Tennis</h2>
            <p>"Esplora il campo da tennis progettato per offrire prestazioni ottimali e divertimento senza fine. Con una superficie impeccabile, linee chiare e una struttura ben curata, il nostro campo da tennis ti permette di allenarti, competere e goderti partite entusiasmanti in un ambiente accogliente e professionale."</p>
            <p>Orari: <br>Bambini: Mar-Ven 16:00-18:00<br>Ragazzi: Lun-Gio 17:00-19:00 Mer 18:00-20:00</p>
            <p>Costi:<br> Lezioni singole a partire da €20. <br>Corsi a partire da €50.</p>
            <p>Istruttori: Giorgio - Leonardo</p>
            <p>Nelle fasce libere i campi sono usufruibili su prenotazione</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/basket.png" alt="Basket">
            <h2>Basket</h2>
            <p>"Esplora il campo da basket, dove la passione e l'energia del gioco si fondono in un'unica esperienza. Lasciati trasportare dalla magia del basket mentre punti al canestro e celebri ogni punto con entusiasmo."</p>
            <p>Orari:<br>Lun-Dom 6:00-22:00</p>
            <p>Costi:<br>Abbonamenti mensili a partire da €30.</p>
            <p>Istruttori: Davide - Stefano</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/piscina.jpg" alt="Nuoto">
            <h2>Nuoto</h2>
            <p>"Immergiti nell'atmosfera rinfrescante e vivace della nostra piscina. Che tu stia facendo qualche vasca per il fitness o semplicemente ti stia rilassando ti offriamo un'oasi di tranquillità e benessere."</p>
            <p>Orari:<br>Lun-Ven 9:00-20:00, Sab-Dom 10:00-18:00</p>
            <p>Costi:<br>Lezioni singole a partire da €20.</p>
            <p>Istruttori: Sabrina - Giulio</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/palestra.png" alt="Palestra">
            <h2>Palestra</h2>
            <p>"Dai pesi liberi alle macchine cardio, dalle lezioni di gruppo alle sessioni personali con istruttori esperti, la nostra palestra offre tutto ciò di cui hai bisogno per tonificare il corpo, aumentare la forza e migliorare la salute generale. Entra e scopri un ambiente accogliente e stimolante dove ogni allenamento ti avvicina sempre di più ai tuoi obiettivi di fitness e benessere."</p>
            <p>Orari: <br>Lun-Ven 9:00-23:00, Sab-Dom 10:00-18:00</p>
            <p>Istruttori: Marta - Giovanni</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
    </div>
    
    <div class="scatola">
        <table>
        <tr>
            <th class="time-column">Ora\Giorno</th>
            <th>Lunedì</th>
            <th>Martedì</th>
            <th>Mercoledì</th>
            <th>Giovedì</th>
            <th>Venerdì</th>
        </tr>
        <?php
            // Connessione al database PostgreSQL
            $conn = pg_connect("host=localhost dbname=Ade_Sporting_Club user=postgres password=eleonora");
            if (!$conn) {
                echo "Errore nella connessione al database.";
                exit;
            }

            // Query per recuperare i dati dalla tabella Orari
            $result = pg_query($conn, "SELECT giorno_settimana, ora_inizio, ora_fine, nome, categoria FROM Orari");

            if ($result) {
                // Array associativo per memorizzare i dati dei corsi per ogni giorno
                $corsi_per_orario = array(
                    "15:00 - 16:00" => array(),
                    "16:00 - 17:00" => array(),
                    "17:00 - 18:00" => array(),
                    "18:00 - 19:00" => array(),
                    "19:00 - 20:00" => array()
                );

                // Riempimento dell'array con i dati dei corsi
                while ($row = pg_fetch_assoc($result)) {
                    $giorno = $row["giorno_settimana"];
                    $inizio_completo = $row["ora_inizio"];
                    $fine_completo = $row["ora_fine"];
                    // Mi assicuro che il nome e la categoria siano minuscoli per i css
                    $nome_corso = strtolower($row["nome"]); 
                    $categoria_corso = strtolower($row["categoria"]); 

                    $inizio = substr($inizio_completo, 0, 5); // Estrae solo i primi 5 caratteri (HH:MM)
                    $fine = substr($fine_completo, 0, 5); // Estrae solo i primi 5 caratteri (HH:MM)


                    // Debug: stampa delle variabili
                    // echo "Giorno: $giorno, Inizio: $inizio, Fine: $fine, Nome corso: $nome_corso, Categoria corso: $categoria_corso <br>";

                    // Costruzione della stringa per l'orario
                    $orario = "$inizio - $fine";

                    // Aggiunta del corso all'array associativo
                    $corsi_per_orario[$orario][$giorno][] = array("nome" => $nome_corso, "categoria" => $categoria_corso);
                }

                // Creazione della tabella HTML
                foreach ($corsi_per_orario as $orario => $corsi_per_giorno) {
                    echo "<tr>";
                    echo "<td>$orario</td>";
                    foreach (["lunedi", "martedi", "mercoledi", "giovedi", "venerdi"] as $giorno) {
                        echo "<td>";
                        if (isset($corsi_per_giorno[$giorno])) {
                            echo "<table class='inner-table'>";
                            foreach ($corsi_per_giorno[$giorno] as $corso) {
                                $nome_corso = $corso["nome"];
                                $categoria_corso = strtolower($corso["categoria"]); // Assicurati che la categoria sia in minuscolo
                                $classe_corso = "corso-$nome_corso-$categoria_corso"; // Costruisci il nome della classe CSS
                                echo "<td class='$classe_corso'>$nome_corso</td>";
                            }
                            echo "</table>";
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "Nessun corso trovato.";
            }

            // Chiusura della connessione al database
            pg_close($conn);
        ?>
        </table>
        <!-- Legenda -->
        <div class="legend">
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #90EE90;"></div> Calcio Bambini: campo 1
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #008000;"></div> Calcio Ragazzi: campo 2
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #FFA500;"></div> Tennis Bambini
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #FF8C00;"></div> Tennis Ragazzi
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #ADD8E6;"></div> Nuoto Bambini
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #4682B4;"></div> Nuoto Ragazzi
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #FF7F50;"></div> Basket Bambini
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #FF4500;"></div> Basket Ragazzi
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #FFFF00;"></div> Paddle Bambini
            </div>
            <div class="legend-item">
                <div class="legend-circle" style="background-color: #FFD700;"></div> Paddle Ragazzi
            </div>
        </div>
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
</body>
</html>