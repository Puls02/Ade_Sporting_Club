function getTimeString(timeString) {
    const [hours, minutes] = timeString.split(':');
    return hours + ':' + minutes; // Ritorna l'ora nel formato HH:MM
}
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
    'piscina':'#90e0ef',
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
                    const response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        console.error(response.error);
                        scheduleActivityDisplay.innerHTML = `<div class="error-message">${response.error}</div>`;
                    } else {
                        let activityHTML = '';
                        const activities = response;
                        
                        activities.forEach(activity => {
                            const activityBackgroundColor = getActivityBackgroundColor(activity.sport || activity.nome);
                            const startTime = activity.ora_inizio || activity.orainizio ? getTimeString(activity.ora_inizio || activity.orainizio) : 'Orario non disponibile';
                            const endTime = activity.ora_fine || activity.orafine ? getTimeString(activity.ora_fine || activity.orafine) : '';
                            const time = endTime ? `${startTime} - ${endTime}` : startTime;
                            const sport = activity.sport || activity.nome;
                            const category = activity.categoria ? `<div class="activity-category">${activity.categoria}</div>` : '';
                
                            activityHTML += `
                                <div class="activity" style="background-color: ${activityBackgroundColor};">
                                    <div class="activity-name">${sport}</div>
                                    ${category}
                                    <div class="activity-time">${time}</div>
                                </div>
                            `;
                        });
                
                        scheduleActivityDisplay.innerHTML = activityHTML;
                    }
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

/* PER CAMBIARE VISUALIZZAZIONE */
function toggleViewEventi() {
    var eventContainer = document.getElementById('event-container');
    var toggleButton = document.getElementById('toggle-view-btn-eventi');

    // Toggle tra griglia ed elenco
    if (eventContainer.classList.contains('grid-view')) {
        eventContainer.classList.remove('grid-view');
        eventContainer.classList.add('list-view');
        toggleButton.textContent = 'Visualizzazione: Elenco';
    } else {
        eventContainer.classList.remove('list-view');
        eventContainer.classList.add('grid-view');
        toggleButton.textContent = 'Visualizzazione: Griglia';
    }
}
function toggleViewCorsi() {
    var eventContainer = document.getElementById('course-container');
    var toggleButton = document.getElementById('toggle-view-btn-corsi');

    // Toggle tra griglia ed elenco
    if (eventContainer.classList.contains('grid-view')) {
        eventContainer.classList.remove('grid-view');
        eventContainer.classList.add('list-view');
        toggleButton.textContent = 'Visualizzazione: Elenco';
    } else {
        eventContainer.classList.remove('list-view');
        eventContainer.classList.add('grid-view');
        toggleButton.textContent = 'Visualizzazione: Griglia';
    }
}
