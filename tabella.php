<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orari dei corsi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- per le cione delle attivita -->

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
        }
        table {
            width: 70%;
            border-collapse: collapse;
            border-spacing: 0;
            border: 1px solid #ddd;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        td {
            background-color: #fff; /* Sfondo bianco per le celle */
            color: #333;
        }
        .time-column {
            width: 15%;
        }
        /* Definizione della larghezza fissa per le celle della tabella interna */
        .inner-table {
            margin: 0;
            border: none;
            font-size: 12px;
        }
        .inner-table td {
            width: 10%; /* Modifica la larghezza a tuo piacimento */
            border: none; 
        }
        /* Colori di sfondo per i nomi dei corsi */
        .corso-calcio-bambini { background-color: #90EE90; color: #333; }
        .corso-calcio-ragazzi { background-color: #008000; color: #fff; }
        .corso-tennis-bambini { background-color: #FFA500; color: #333; }
        .corso-tennis-ragazzi { background-color: #FF8C00; color: #fff; }
        .corso-nuoto-bambini { background-color: #ADD8E6; color: #333; }
        .corso-nuoto-ragazzi { background-color: #4682B4; color: #fff; }
        .corso-basket-bambini { background-color: #FF7F50; color: #333; }
        .corso-basket-ragazzi { background-color: #FF4500; color: #fff; }
        .corso-paddle-bambini { background-color: #FFFF00; color: #333; }
        .corso-paddle-ragazzi { background-color: #FFD700; color: #fff; }
        /* Stile per la legenda */
        .legend {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-left: 20px; /* Aggiunge un margine a sinistra per separare la legenda dalla tabella */
        }
        .legend-item {
            margin-bottom: 5px;
        }
        .legend-circle {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }


        #calendar {
  display: grid;
  grid-template-columns: repeat(7, minmax(0, 1fr)); /* Modifica */
  grid-auto-rows: 70px; /* Altezza delle righe del calendario */
  
}

.giorno {
  padding: 0;
  margin: 0;
  border: none;
  text-align: center;
  position: relative;
  display: flex; /* Aggiunta */
  justify-content: center; /* Aggiunta */
  align-items: center; /* Aggiunta */
}

.giorno-header {
  font-weight: bold;
  background-color: rgb(43, 128, 226);
}

.current-month {
  cursor: pointer;
}

.current-month:hover {
  background-color: #f0f0f0;
  border-radius: 10px;
}

.today {
  background-color: rgb(126, 207, 231);
  border-radius: 10px;
}

.weekly-schedule {
  margin-top: 20px;
}

.schedule-header {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.schedule-date {
  font-size: 20px;
  font-weight: bold;
}

.schedule-activity {
  margin-top: 25px;
}

.activity {
  border-radius: 10px;
  padding: 2%;
  margin: 2%;
}

.activity-item {
  margin-bottom: 5px;
  background-color: yellow;
}

.activity-name {
  font-weight: bold;
}


/* Aggiungi altri stili CSS secondo le tue preferenze */

    </style>
</head>
<body>
<div class="calendario">
            <h2 id="currentMonth"></h2>
            <div id="calendar">

            </div>
        </div>
        <div class="weekly-schedule">
            <div class="schedule-date">

            </div>
            <!-- Qui verrà aggiunta la data e le attività -->
            <div class="schedule-activity">

            </div>
        </div>

</div>



<br>
<h2 style="text-align: center;">Orari dei corsi</h2>

<div class="container">
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
        $conn = pg_connect("host=localhost dbname=Ade_Sporting_Club user=postgres password=Sporting77!");
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
                        
                        // Creazione di una cella per ogni corso in ordine specifico
                        foreach (["calcio", "paddle", "tennis", "nuoto", "basket"] as $nome_corso) {
                            foreach (["bambini", "ragazzi"] as $categoria_corso) {
                                $trovato = false;
                                foreach ($corsi_per_giorno[$giorno] as $corso) {
                                    if ($corso["nome"] === $nome_corso && $corso["categoria"] === $categoria_corso) {
                                        $classe_corso = "corso-$nome_corso-$categoria_corso"; // Costruisci il nome della classe CSS
                                        echo "<td class='$classe_corso'>{$corso['nome']}</td>";
                                        $trovato = true;
                                        break;
                                    }
                                }
                                if (!$trovato) {
                                    echo "<td></td>";
                                }
                            }
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
            <div class="legend-circle" style="background-color: #90EE90;"></div> Calcio Bambini
        </div>
        <div class="legend-item">
            <div class="legend-circle" style="background-color: #008000;"></div> Calcio Ragazzi
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
<br>
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
        $result = pg_query($conn, "SELECT * FROM prenotazioni");

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
                    $sfondo = $completa == 't' ? "green" : "red"; // Sfondo verde se completa, rosso altrimenti

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

    
<script>
// Definizione della classe per le attività
class Activity {
    constructor(name) {
        this.name = name;
    }

    render() {
        return `<li class="activity-item">${this.name}</li>`;
    }
}

const calendar = document.getElementById('calendar');
const currentMonthDisplay = document.getElementById('currentMonth');
const scheduleDateDisplay = document.querySelector('.schedule-date');
const scheduleActivityDisplay = document.querySelector('.schedule-activity');

function generateCalendar(year, month) {
    const startDate = new Date(year, month, 1);
    const endDate = new Date(year, month + 1, 0);
    const startDay = startDate.getDay();

    let html = '';

    // Mostra il nome del mese e l'anno
    const monthNames = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
    currentMonthDisplay.textContent = monthNames[month] + ' ' + year;

    // Aggiungi intestazione dei giorni
    const days = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];
    html += '<div class="giorno giorno-header">' + days.join('</div><div class="giorno giorno-header">') + '</div>';

    // Aggiungi giorni del mese precedente
for (let i = startDay - 1; i >= 0; i--) {
    const prevMonthDay = new Date(year, month, -i);
    html += '<div class="giorno other-month" data-day=""></div>';
}

// Aggiungi giorni del mese corrente
for (let giorno = 1; giorno <= endDate.getDate(); giorno++) {
    if (giorno === new Date().getDate() && year === new Date().getFullYear() && month === new Date().getMonth()) {
        html += '<div class="giorno current-month today" data-day="' + giorno + '">' + giorno + '</div>';
    } else {
        html += '<div class="giorno current-month" data-day="' + giorno + '">' + giorno + '</div>';
    }
}

// Associazioni tra nomi di attività e colori di sfondo
const activityBackgroundColors = {
    'calcio': '#a7c957',
    'tennis': '#fec89a',
    'basket': '#fcd5ce',
    'nuoto':'#90e0ef',
    'paddle':'#fff3b0',
    'palestra':'#dee2ff',
    // Aggiungi altri nomi di attività e colori di sfondo desiderati
};

// Funzione per ottenere il colore di sfondo in base al nome dell'attività
function getActivityBackgroundColor(activityName) {
    return activityBackgroundColors[activityName.toLowerCase()] || 'gray';
}


    calendar.innerHTML = html;

// Aggiungi evento clic per visualizzare la data selezionata nella sezione weekly-schedule
const dayElements = document.querySelectorAll('.current-month');
dayElements.forEach(dayElement => {
    dayElement.addEventListener('click', function() {
        const selectedDay = this.getAttribute('data-day');
        const currentDate = new Date(Date.UTC(year, month, selectedDay));
        const formattedDate = currentDate.toISOString().slice(0,10); // Formatta la data nel formato YYYY-MM-DD
        scheduleDateDisplay.textContent = formatDate(currentDate);

        // Effettua una richiesta AJAX per ottenere i dati delle attività per la data selezionata dal server PHP
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const activities = JSON.parse(xhr.responseText);
                    let activityHTML = '';
    
                    activities.forEach(activity => {
                        const activityBackgroundColor = getActivityBackgroundColor(activity.corso);
                        // Verifica se sia l'orario di inizio che quello di fine sono definiti e non vuoti
                        const startTime = activity.orarioinizio ? getTimeString(activity.orarioinizio) : 'Orario non disponibile';
                        const endTime = activity.orariofine ? getTimeString(activity.orariofine) : '';
                    
                        // Verifica se l'orario di fine è definito e non vuoto, se sì, aggiungi anche l'orario di fine
                        const time = endTime ? `${startTime} - ${endTime}` : startTime;
                    
                        activityHTML += `
                            <div class="activity" style="background-color: ${activityBackgroundColor};">
                                <div class="activity-name">${activity.corso}</div>
                                <div class="activity-time">${time}</div>
                            </div>
                        `;
                    });
                    
                    // Funzione per estrarre solo ore e minuti da un'ora nel formato HH:MM
                    function getTimeString(timeString) {
                        const [hours, minutes] = timeString.split(':');
                        return `${hours}:${minutes}`;
                    }
                    
                    
                    
                    
                    scheduleActivityDisplay.innerHTML = activityHTML;
                } else {
                    console.error('Errore durante il recupero dei dati delle attività.');
                }
            }
        };
        xhr.open('GET', '../php/get-activities.php?date=' + formattedDate, true);
        xhr.send();
    });
});


// Funzione per formattare la data nel formato richiesto (es. "MER 15")
function formatDate(date) {
    const days = ['DOM', 'LUN', 'MAR', 'MER', 'GIO', 'VEN', 'SAB'];
    const dayName = days[date.getDay()];
    const dayOfMonth = date.getDate();
    return `${dayName} ${dayOfMonth}`;
}

}

// Genera il calendario per il mese corrente
const currentDate = new Date();
generateCalendar(currentDate.getFullYear(), currentDate.getMonth());

// Simula il click sul giorno corrente per visualizzare le attività di default
const currentDayElement = document.querySelector('.today');
if (currentDayElement) {
    currentDayElement.click();
}



</script>
</body>
</html>
