<?php
    session_start();

    $logged=isset($_SESSION['logged_in']);

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // Se l'utente non è loggato, imposta una variabile di JavaScript per mostrare il messaggio
        echo "<script>var loggedIn = false;</script>";
    } else {
        // Se l'utente è loggato, imposta la variabile di JavaScript per indicare che è loggato
        echo "<script>var loggedIn = true;</script>";
    }
    
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
    <link rel="stylesheet" href="Style/prenota.css"> 

    <!-- Link ai file javascript -->
    <script src="js/login.js" defer></script>
    <script src="js/navbar.js" defer></script>
    <script src="js/prenotazioni.js" defer></script>

    <!--Script javascript-->
    <script>
        // Funzione per controllare se l'utente è loggato prima di consentire il clic
        function checkLogin() {
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

    <h1>DISPONIBILITA DEI CAMPI</h1>
    <p>tabella complementare a quella della pagina attività in cui ci sono i campi occupati</p>  
    <div class="zona">
        <div class="schedule">
            <table>
                <tr>
                    <th>Ora</th>
                    <th class="field">Lunedì</th>
                    <th class="field">Martedì</th>
                    <th class="field">Mercoledì</th>
                    <th class="field">Giovedì</th>
                    <th class="field">Venerdì</th>
                    <th class="field">Sabato</th>
                    <th class="field">Domenica</th>
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
    </div>

    <!-- io inserirei a destra di ogni tendina un post it con le informazioni relative ai costi dei campi -->
    <div>

        <ul class="toggle-list" >
            <li class="toggle-item" onclick="return checkLogin();">
                <input type="radio" id="calcio" name="attivita">
                <label for="calcio" >Calcetto<span class="arrow" ></span></label>
                <div class="content">
                    <form action="php/checkLogin.php" method="php/prenotazione.php">
                        <label for="dataCalcio">Data:</label>
                        <input type="date" id="dataCalcio" name="data"><br>
                        <label for="orario">Seleziona un orario:</label>
                        <select class="orario" name="ora">
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
                        <input type="date" id="dataPaddle" name="data"><br>
                        <label for="orario">Seleziona un orario:</label>
                        <select class="orario" name="ora">
                            <option value="">Seleziona un orario</option>
                        </select><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="paddle_1">Campo 1</option>
                            <option value="paddle_2">Campo 2</option>
                            <option value="paddle_3">Campo 3</option>
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
                        <input type="date" id="dataTennis" name="data"><br>
                        <label for="orario">Seleziona un orario:</label>
                        <select class="orario" name="ora">
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
                        <input type="date" id="dataBasket" name="data"><br>
                        <label for="orario">Seleziona un orario:</label>
                        <select class="orario" name="ora">
                            <option value="">Seleziona un orario</option>
                        </select><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="Basket_1">Campo 1</option>
                            <option value="Basket_2">Campo 2</option>
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
                        <input type="date" id="dataNuoto" name="data"><br>
                        <!-- se possibile mettiamo in elenco solo le fasce disponibili -->
                        <label for="orarioNuoto">Scegli una fascia oraria:</label>
                        <select name="type" id="orarioNuoto" name="ora"  required>
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
                        <input type="date" id="dataPalestra" name="data"><br>
                        <!-- se possibile mettiamo in elenco solo le fasce disponibili -->
                        <label for="orario">Seleziona un orario:</label>
                        <select class="orario" name="ora">
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