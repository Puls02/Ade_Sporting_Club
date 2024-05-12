<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orari dei corsi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
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
            margin-top: 20px;
            float: right; /* Posiziona la legenda a destra */
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
    </style>
</head>
<body>

<h2 style="text-align: center;">Orari dei corsi</h2>

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


</body>
</html>
