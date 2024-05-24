function getTimeString(timeString) {
    const [hours, minutes] = timeString.split(':');
    return hours + ':' + minutes; // Returns the time in HH:MM format
}
// Definition of the class for the activities
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

    // Shows the name of the month and the year
    const monthNames = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
    currentMonthDisplay.textContent = monthNames[month] + ' ' + year;

    // Add day header
    const days = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];
    html += '<div class="giorno giorno-header">' + days.join('</div><div class="giorno giorno-header">') + '</div>';

    // Add days from the previous month
for (let i = startDay - 1; i >= 0; i--) {
    const prevMonthDay = new Date(year, month, -i);
    html += '<div class="giorno other-month" data-day=""></div>';
}

// Add days of the current month
for (let giorno = 1; giorno <= endDate.getDate(); giorno++) {
    if (giorno === new Date().getDate() && year === new Date().getFullYear() && month === new Date().getMonth()) {
        html += '<div class="giorno current-month today" data-day="' + giorno + '">' + giorno + '</div>';
    } else {
        html += '<div class="giorno current-month" data-day="' + giorno + '">' + giorno + '</div>';
    }
}

// Associations between activity names and background colors
const activityBackgroundColors = {
    'calcio': '#a7c957',
    'tennis': '#fec89a',
    'basket': '#fcd5ce',
    'piscina':'#90e0ef',
    'paddle':'#fff3b0',
    'palestra':'#dee2ff',
    // Add any other business names and background colors you want
};

// Function to get background color based on task name
function getActivityBackgroundColor(activityName) {
    return activityBackgroundColors[activityName.toLowerCase()] || 'gray';
}


    calendar.innerHTML = html;

// Add click event to display the selected date in the weekly-schedule section
const dayElements = document.querySelectorAll('.current-month');
dayElements.forEach(dayElement => {
    dayElement.addEventListener('click', function() {
        const selectedDay = this.getAttribute('data-day');
        const currentDate = new Date(Date.UTC(year, month, selectedDay));
        const formattedDate = currentDate.toISOString().slice(0,10); // Format the date in YYYY-MM-DD format
        scheduleDateDisplay.textContent = formatDate(currentDate);

        // Get the current date without time for comparison
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Make an AJAX request to get activity data for the selected date from the PHP server
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
                        const prenotazioni = response.prenotazioni;
                        
                        prenotazioni.forEach(activity => {
                            const user=activity.utente;
                            const activityBackgroundColor = getActivityBackgroundColor(activity.sport || activity.nome);
                            const startTime = activity.ora_inizio || activity.orainizio ? getTimeString(activity.ora_inizio || activity.orainizio) : 'Orario non disponibile';
                            const endTime = activity.ora_fine || activity.orafine ? getTimeString(activity.ora_fine || activity.orafine) : '';
                            const time = endTime ? `${startTime} - ${endTime}` : startTime;
                            const sport = activity.sport || activity.nome;
                            const category = activity.categoria ? `<div class="activity-category">${activity.categoria}</div>` : '';
                            const id_reservation =activity.id_prenotazione;

                            const activityDate = new Date(activity.data);
                            // print activity day: the value of activityDate
                            console.log("giorno attivita",activityDate);
                            
                            // print the value of currentDate
                            console.log("giorno corrente",today);
                            let deleteButtonHTML = '';
                            if (activityDate >= today) {
                                deleteButtonHTML = `<button onclick="deleteReservation(${id_reservation}, ${user})"> ELIMINA </button>`;
                            }

                            activityHTML += `
                                <div class="activity" style="background-color: ${activityBackgroundColor};">
                                    <div class="activity-name">${sport}</div>
                                    ${category}
                                    <div class="activity-time">${time}</div>
                                    ${deleteButtonHTML}
                                </div>
                                <div id="myModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <div id="modalContent">
                                            Sei sicuro di voler eliminare la prenotazione?
                                        </div>
                                        <button id="actionButton">SI</button>
                                        <button id="noButton">NO</button>
                                    </div>
                                </div>
                            `;
                        });

                        const corsi = response.corsi;
                        corsi.forEach(activity => {
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


// Function to format the date in the required format (e.g. "WED 15")
function formatDate(date) {
    const days = ['DOM', 'LUN', 'MAR', 'MER', 'GIO', 'VEN', 'SAB'];
    const dayName = days[date.getDay()];
    const dayOfMonth = date.getDate();
    return `${dayName} ${dayOfMonth}`;
}

}
// to delete the reservation
function deleteReservation(id_reservation,user){
    // Show the modal window
    var modal = document.getElementById("myModal");
    modal.style.display = "block";

    // Close modal window when user clicks 'x'
    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
    //button no
    var noButton = document.getElementById("noButton");
    noButton.onclick = function(){
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    };

    //yes button
    var siButton = document.getElementById("actionButton");
    siButton.onclick = function(){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/eliminaPrenotazione.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert("Errore: " + response.message);
                }
                modal.style.display = "none";
            }
        };
        const params = `id_prenotazione=${encodeURIComponent(id_reservation)}&utente=${encodeURIComponent(user)}`;
        xhr.send(params);
    };

    // Close the modal window when the user clicks out of the window
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

}

// Generate the calendar for the current month
const currentDate = new Date();
generateCalendar(currentDate.getFullYear(), currentDate.getMonth());

// Simulate clicking on the current day to view the default activities
const currentDayElement = document.querySelector('.today');
if (currentDayElement) {
    currentDayElement.click();
}

/* TO CHANGE VIEW */
function toggleViewEventi() {
    var eventContainer = document.getElementById('event-container');
    var toggleButton = document.getElementById('toggle-view-btn-eventi');

    // Toggle between grid and list
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
