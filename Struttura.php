<?php
    session_start();
    $_SESSION['url']=$_SERVER['REQUEST_URI'];
    $logged=isset($_SESSION['logged_in']);
    $gold=isset($_SESSION['gold']);
    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
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
    
    <link rel="icon" type="image/png" sizes="32x32" href="immagini/logo/favicon2.png">
    <title>Ade Sporting Club</title>

    <!--Link to style folder-->
    <link rel="StyleSheet" href="Style/utility.css">
    <link rel="StyleSheet" href="Style/scorrimentoAlto.css">
    <link rel="StyleSheet" href="Style/navbar.css">
    <link rel="StyleSheet" href="Style/footer.css">
    <link rel="StyleSheet" href="Style/struttura.css">
    <link rel="stylesheet" href="Style/popup.css"> 
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- for activity icons -->

    <!-- Link ai file javascript -->
    <script src="js/login.js" defer></script>
    <script src="js/struttura.js" defer></script>
    <script src="js/messaggi.js" defer></script>
</head>

<body>
    <header id="beginning"> 
        <nav class="nav responsive">
            <!--container for logo and name -->
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
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                </div>

                <div class="person flex">
                    <ul class="login_menu">
                        <!-- PHP condition to show login menu -->
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
                            <!-- PHP condition to show profile -->
                            <li>
                                <?php if ($id < 30) : ?>
                                    <a href="login_registrazione/Istruttore.php">
                                        <button class="Sign profile">Profilo</button>
                                    </a>
                                <?php elseif ($id >= 30 && !$gold) : ?>
                                    <a href="login_registrazione/utenteNonGold.php">
                                        <button class="Sign profile">Profilo</button>
                                    </a>
                                <?php else : ?>
                                    <a href="login_registrazione/utenteGold.php">
                                        <button class="Sign profile">Profilo</button>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <li>
                                <form action="php/logout.php" method="post">
                                    <button class="Sign out" type="submit">Logout</button>
                                </form>
                            </li>
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

                // function to show the drop-down menu
const show_menu = document.querySelector('.login_btn');
  nav = document.querySelector('.person');

  show_menu.onclick = () => {
    nav.classList.toggle("show");
};
            </script>
            <!-- end javascript -->
        </nav>
        
    </header>

    <!-- Overlay div -->
    <div id="overlay" class="overlay"></div>
    <!-- Hidden popup div -->
    <div id="popup" class="popup">
        <iframe src="login_registrazione/login.php" width="580" height="500" frameborder="0" style="border:0; overflow:hidden;" allowfullscreen="" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <main>
        <div class="Sezione_1">
            <img class="bg_img" src="immagini/galleria/presentazione/banner2.jpg">
            <div class="presentation">
                <h1>Cosa offre il nostro club</h1>
                <p>La nostra struttura, immersa nel cuore di Roma, offre un rifugio per gli appassionati di fitness, gli atleti e le famiglie.
                    <br>
                    Ci impegniamo a fornire un ambiente dinamico e inclusivo in cui persone di tutte le età e abilità possono perseguire i propri obiettivi e scoprire la gioia 
                    di uno stile di vita attivo. 
                    Le nostre strutture all'avanguardia vantano attrezzature all'ultimo grido, servizi moderni e personale qualificato impegnato ad aiutarti a raggiungere le tue 
                    aspirazioni di fitness. Dall'attrezzatura da palestra all'avanguardia a campi sportivi versatili e ampie aree di allenamento, offriamo una gamma diversificata di 
                    attività e programmi adattati alle tue esigenze.
                    <br>
                    <br>
                    Ma il nostro impegno va oltre il semplice fitness. Crediamo nel favorire un senso di comunità e cameratismo tra i nostri membri, creando un ambiente di sostegno 
                    e motivazione in cui puoi prosperare sia dentro che fuori dalla palestra. Perciò, che tu voglia sudare, fare nuove amicizie o semplicemente rilassarti dopo una lunga 
                    giornata, unisciti a noi e 
                    intraprendi un viaggio verso un te più sano e felice. 
                </p>
            </div>
        </div>
        <div class="Sezione_2">
            <div class="Services">
                <div class="fisso" id="descrizione-fissa">
                    <h1 id="titolo-servizio"></h1>
                    <img id="immagine-servizio" src="" alt="Immagine Servizio">
                    <p id="descrizione-servizio"></p>
                </div>

                <div class="service">
                    <h1 id="bar-title"><i class="fas fa-coffee"></i> Bar</h1>
                    <p id="bar-desc">Godetevi una varietà di bevande e snack all'interno della nuova area; il luogo ideale per rilassarsi dopo una partita o per gustare un drink con gli amici. 
                        <br> 
                        Offriamo una selezione di cocktail, birre e vini nonchè di bevande proteiche e energizzanti.
                        <br><br> 
                        Orari: 8:00 - 24:00 
                    </p>
                </div>
            
                <div class="service">
                    <h1 id="pool-title"><i class="fas fa-swimmer"></i> Piscina</h1>
                    <p id="pool-desc">Rilassatevi o fate qualche vasca nella piscina, perfetta per rinfrescarsi durante le giornate calde estive. 
                        La zona è costantemente sorvegliata da personale qualificato per garantire la sicurezza di tutti.
                        <br><br> 
                        Orari: 11:00 - 19:00
                    </p>
                </div>
            
                <div class="service">
                    <h1 id="rec-title"><i class="fas fa-user"></i> Reception</h1>
                    <p id="rec-desc">Il nostro staff cordiale è a vostra disposizione per assistervi con qualsiasi richiesta o informazione sulle attività del circolo.
                    <br><br> 
                    Orari: 8:00 - 23:00
                    </p>
                </div>
            
                <div class="service">
                    <h1 id="rest-title"><i class="fas fa-utensils"></i> Ristorante</h1>
                    <p id="rest-desc">Assaporate piatti deliziosi preparati dai nostri chef nel ristorante del circolo. 
                        Il nostro ristorante offre una vasta selezione di piatti deliziosi, dai pasti leggeri alle pietanze gourmet, il tutto accompagnato da una varietà di bevande.
                        <br><br>
                        Pranzo: 12:00 - 15:00 
                        <br>
                        Cena: 19:00 - 00:00
                    </p>
                </div>
                <div class="space resp"></div>
                <hr size="1" color="black"> 
                <div class="space"></div>
                <!-- Image Gallery -->
                <div class="gallery">
                    <img src="immagini/galleria/presentazione/piantina.jpg" alt="piantina">
                    <img src="immagini/galleria/presentazione/calcio.jpg" alt="calcio">
                    <img src="immagini/galleria/presentazione/calcio2.jpg" alt="calcio">
                    <img src="immagini/galleria/presentazione/basket.jpg" alt="basket">
                    <img src="immagini/galleria/presentazione/basket2.jpg" alt="basket">
                    <img src="immagini/galleria/presentazione/padel.png" alt="padel">
                    <img src="immagini/galleria/presentazione/padel2.jpg" alt="padel">
                    <img src="immagini/galleria/presentazione/padel3.jpg" alt="padel">
                    <img src="immagini/galleria/presentazione/palestra.png" alt="palestra">
                    <img src="immagini/galleria/presentazione/tennis.jpg" alt="tennis">
                    <img src="immagini/galleria/presentazione/tennis2.jpg" alt="tennis">
                </div>
            </div>
        </div>
    </main>
<!-- Footer section with contacts -->	  
<footer>
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
</body>
</html>