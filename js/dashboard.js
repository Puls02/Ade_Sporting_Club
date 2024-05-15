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

//PER LA BARRA DI PROGRESSO
    // Data di inizio e fine dell'abbonamento (formato: "YYYY-MM-DD")
var startDate = new Date("2024-05-01"); // Data di inizio
var endDate = new Date("2024-06-01"); // Data di fine

// Calcola la percentuale di completamento dell'abbonamento
var cDate = new Date();
var progress = (cDate - startDate) / (endDate - startDate) * 100;

// Imposta la larghezza della barra di progresso
var progressBar = document.querySelector('.progress-indicator');
progressBar.style.width = progress + '%';