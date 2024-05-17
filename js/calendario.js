document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const currentMonthEl = document.getElementById('currentMonth');
    const currentDate = new Date();
    let currentYear = currentDate.getFullYear();
    let currentMonth = currentDate.getMonth();

    function loadCalendar(year, month) {
        // Set current month name
        const monthNames = [
            'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno',
            'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
        ];
        currentMonthEl.textContent = `${monthNames[month]} ${year}`;

        // Clear previous calendar
        calendarEl.innerHTML = '';

        // Days in month
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const firstDayIndex = new Date(year, month, 1).getDay();

        // Add blank days
        for (let i = 0; i < firstDayIndex; i++) {
            const blankDay = document.createElement('div');
            blankDay.classList.add('day');
            calendarEl.appendChild(blankDay);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayEl = document.createElement('div');
            dayEl.classList.add('day');
            dayEl.textContent = day;
            dayEl.dataset.date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            calendarEl.appendChild(dayEl);
        }

        // Fetch reservations and color the days
        fetch('getPrenotazioni.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(date => {
                    const dateEl = document.querySelector(`.day[data-date="${date}"]`);
                    if (dateEl) {
                        dateEl.classList.add('prenotato');
                    }
                });
            })
            .catch(error => console.error('Error fetching reservations:', error));
    }

    loadCalendar(currentYear, currentMonth);
});