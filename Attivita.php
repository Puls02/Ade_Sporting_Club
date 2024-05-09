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
    <link rel="icon" type="image/png" sizes="32x32" href="immagini/logo/favicon.png">
    <title>Ade Sporting Club</title>

    <!--Link to style folder-->
    <link rel="StyleSheet" href="Style/utility.css">
    <link rel="StyleSheet" href="Style/navbarStatic.css">
    <link rel="StyleSheet" href="Style/login.css">
    <link rel="StyleSheet" href="Style/footer.css">
    <link rel="StyleSheet" href="Style/index.css">
    <link rel="StyleSheet" href="Style/gallery.css">
    <link rel="stylesheet" href="Style/popup.css">
    <link rel="stylesheet" href="Style/attivita.css"> 

    <!-- Link ai file javascript -->
    <script src="js/login.js" defer></script>
    <script src="js/navbar.js" defer></script>
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
                <li>
                    <a class="toolbar_link_Soci" href="Soci.html">Soci</a> 
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
                        <form action="php/logout.php" method="post" >
                            <button type="submit">Logout</button>
                        </form>
                    </ul>
                </div>
            <?php endif; ?>
            
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
        <h1>I CORSI</h1>
        <div class="activity">
            <img src="immagini/sfondo_index/calcio.png" alt="Tennis">
            <h2>Calcio</h2>
            <p>Scopri il nostro campo da tennis professionale. Offriamo lezioni per principianti e avanzati.</p>
            <p>Orari: Lun-Ven 9:00-20:00, Sab-Dom 10:00-18:00</p>
            <p>Costi: Lezioni singole a partire da €20.</p>
            <p>Istruttori: Marco</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/padel.png" alt="Tennis">
            <h2>Paddle</h2>
            <p>Scopri il nostro campo da tennis professionale. Offriamo lezioni per principianti e avanzati.</p>
            <p>Orari: Lun-Ven 9:00-20:00, Sab-Dom 10:00-18:00</p>
            <p>Costi: Lezioni singole a partire da €20.</p>
            <p>Istruttori: Marco</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/tennis.png" alt="Tennis">
            <h2>Tennis</h2>
            <p>Scopri il nostro campo da tennis professionale. Offriamo lezioni per principianti e avanzati.</p>
            <p>Orari: Lun-Ven 9:00-20:00, Sab-Dom 10:00-18:00</p>
            <p>Costi: Lezioni singole a partire da €20.</p>
            <p>Istruttori: Marco</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/basket.png" alt="Nuoto">
            <h2>Basket</h2>
            <p>Vieni a nuotare nella nostra piscina olimpionica. Corsi per bambini e adulti.</p>
            <p>Orari: Lun-Dom 6:00-22:00</p>
            <p>Costi: Abbonamenti mensili a partire da €30.</p>
            <p>Istruttori: Marco</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/piscina.jpg" alt="Tennis">
            <h2>Nuoto</h2>
            <p>Scopri il nostro campo da tennis professionale. Offriamo lezioni per principianti e avanzati.</p>
            <p>Orari: Lun-Ven 9:00-20:00, Sab-Dom 10:00-18:00</p>
            <p>Costi: Lezioni singole a partire da €20.</p>
            <p>Istruttori: Marco</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
        <div class="activity">
            <img src="immagini/sfondo_index/palestra.png" alt="Tennis">
            <h2>Palestra</h2>
            <p>Scopri il nostro campo da tennis professionale. Offriamo lezioni per principianti e avanzati.</p>
            <p>Orari: Lun-Ven 9:00-20:00, Sab-Dom 10:00-18:00</p>
            <p>Costi: Lezioni singole a partire da €20.</p>
            <p>Istruttori: Marco</p>
            <a href="Prenota.php">Prenota un campo</a>
        </div>
    </div>
    <div class="scatola">
        <h1>IL PROGRAMMA</h1>
        <div class="schedule">
            <table>
                <tr>
                    <th>Ora</th>
                    <th class="field">Calcio</th>
                    <th class="field">Paddle</th>
                    <th class="field">Tennis</th>
                    <th class="field">Basket</th>
                    <th class="field">Nuoto</th>
                    <th class="field">Palestra</th>
                </tr>
                <tr>
                    <td>8:00 - 9:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>9:00 - 10:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>10:00 - 11:00</td>
                    <td>Ins1</td>
                    <td>Ins2</td>
                    <td></td>
                </tr>
                <tr>
                    <td>11:00 - 12:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>12:00 - 13:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>13:00 - 14:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>14:00 - 15:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>15:00 - 16:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>16:00 - 17:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>17:00 - 18:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>18:00 - 19:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>19:00 - 20:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>20:00 - 21:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
                <tr>
                    <td>21:00 - 22:00</td>
                    <td>Ins1</td>
                    <td></td>
                    <td>Ins2</td>
                </tr>
            </table>
        </div>
        <div class="legend">
            <ul class="legend-list">
                <li class="legend-item">
                    <span class="field" style="background-color: #ff6b6b;"></span>
                    Insegnante 1 - Calcio 1
                </li>
                <li class="legend-item">
                    <span class="field" style="background-color: #6bd1ff;"></span>
                    Insegnante 2 - Calciotto
                </li>
                <li class="legend-item">
                    <span class="field" style="background-color: #ffd76b;"></span>
                    Insegnante 3 - Basket
                </li>
            </ul>
        </div>
    </div>
    <div class="prenotazione">

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