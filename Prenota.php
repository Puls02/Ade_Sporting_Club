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
    <link rel="StyleSheet" href="Style/index.css">
    <link rel="StyleSheet" href="Style/gallery.css">
    <link rel="stylesheet" href="Style/popup.css">
    <link rel="stylesheet" href="Style/prenota.css"> 

    <!-- Link ai file javascript -->
    <script src="js/login.js" defer></script>
    <script src="js/navbar.js" defer></script>
    <script src="js/prenotazioni.js" defer></script>

    <!--Link al framework jquery-->
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
            <li class="toggle-item" >
                <input type="radio" id="calcio" name="attivita">
                <label for="calcio" >Calcio<span class="arrow" ></span></label>
                <div class="content">
                    <form action="php/checkLogin.php" method="post" >
                        <label for="nomeCalcio">Nome:</label>
                        <input type="text" id="nomeCalcio" name="nomeCalcio"><br>
                        <label for="cognomeCalcio">Cognome:</label>
                        <input type="text" id="cognomeCalcio" name="cognomeCalcio"><br>
                        <label for="dataCalcio">Data:</label>
                        <input type="date" id="dataCalcio" name="dataCalcio"><br>
                        <label for="orario">Orario prenotazione:</label>
                        <input type="time" id="orario" name="orario" required><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="campo1">Campo 1</option>
                            <option value="campo2">Campo 2</option>
                            <option value="campo3">Campo 3</option>
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
            <li class="toggle-item">
                <input type="radio" id="paddle" name="attivita">
                <label for="paddle">Paddle<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="/upload">
                        <label for="nomePaddle">Nome:</label>
                        <input type="text" id="nomePaddle" name="nomePaddle"><br>
                        <label for="cognomePaddle">Cognome:</label>
                        <input type="text" id="cognomePaddle" name="cognomePaddle"><br>
                        <label for="dataPaddle">Data:</label>
                        <input type="date" id="dataPaddle" name="dataPaddle"><br>
                        <label for="orario">Orario prenotazione:</label>
                        <input type="time" id="orario" name="orario" required><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="campo1">Campo 1</option>
                            <option value="campo2">Campo 2</option>
                            <option value="campo3">Campo 3</option>
                            <option value="campo3">Campo 4</option>
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
            <li class="toggle-item">
                <input type="radio" id="tennis" name="attivita">
                <label for="tennis">Tennis<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="/upload">
                        <label for="nomeTennis">Nome:</label>
                        <input type="text" id="nomeTennis" name="nomeTennis"><br>
                        <label for="cognomeTennis">Cognome:</label>
                        <input type="text" id="cognomeTennis" name="cognomeTennis"><br>
                        <label for="dataTennis">Data:</label>
                        <input type="date" id="dataTennis" name="dataTennis"><br>
                        <label for="orario">Orario prenotazione:</label>
                        <input type="time" id="orario" name="orario" required><br>
                        <label for="sceltacampo">Tipo di prenotazione:</label><br>
                        <input type="radio" id="terra" name="sceltacampo" value="terra" required>
                        <label for="terra">Campo in terra</label><br>
                        <input type="radio" id="cemento" name="sceltacampo" value="cemento">
                        <label for="cemento">Campo in cemento</label><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="campo1">Campo 1</option>
                            <option value="campo2">Campo 2</option>
                            <option value="campo3">Campo 3</option>
                            <option value="campo3">Campo 4</option> <!-- con js fai il controllo, i primi due so di terra e gli altri due in cemento -->
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
            <li class="toggle-item">
                <input type="radio" id="basket" name="attivita">
                <label for="basket">Basket<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="/upload">
                        <label for="nomeBasket">Nome:</label>
                        <input type="text" id="nomeBasket" name="nomeBasket"><br>
                        <label for="cognomeBasket">Cognome:</label>
                        <input type="text" id="cognomeBasket" name="cognomeBasket"><br>
                        <label for="dataBasket">Data:</label>
                        <input type="date" id="dataBasket" name="dataBasket"><br>
                        <label for="orario">Orario prenotazione:</label>
                        <input type="time" id="orario" name="orario" required><br>
                        <label for="campo">Seleziona campo:</label><br>
                        <select id="campo" name="campo" required>
                            <option value="campo1">Campo 1</option>
                            <option value="campo2">Campo 2</option>
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
            <li class="toggle-item">
                <input type="radio" id="nuoto" name="attivita">
                <label for="nuoto">Nuoto<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="/upload">
                        <label for="nomeNuoto">Nome:</label>
                        <input type="text" id="nomeNuoto" name="nomeNuoto"><br>
                        <label for="cognomeNuoto">Cognome:</label>
                        <input type="text" id="cognomeNuoto" name="cognomeNuoto"><br>
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
            <li class="toggle-item">
                <input type="radio" id="palestra" name="attivita">
                <label for="palestra">Palestra<span class="arrow"></span></label>
                <div class="content">
                    <form method="post" action="/upload">
                        <label for="nomePalestra">Nome:</label>
                        <input type="text" id="nomePalestra" name="nomePalestra"><br>
                        <label for="cognome">Cognome:</label>
                        <input type="text" id="cognomePalestra" name="cognomePalestra"><br>
                        <label for="dataPalestra">Data:</label>
                        <input type="date" id="dataPalestra" name="dataPalestra"><br>
                        <!-- se possibile mettiamo in elenco solo le fasce disponibili -->
                        <label for="orarioPalestra">Scegli una fascia oraria:</label>
                        <select name="type" id="orarioPalestra"  required>
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
</body>
</html>