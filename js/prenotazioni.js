// Chiudi il form quando si clicca sull'attività
document.querySelectorAll('.toggle-item input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('click', function() {
      var content = this.parentNode.querySelector('.content');
      if (content.style.display === 'block') {
        content.style.display = 'none';
      } else {
        document.querySelectorAll('.content').forEach(function(item) {
          item.style.display = 'none';
        });
        content.style.display = 'block';
      }
    });
});

// Nascondi il campo Numero di persone quando viene selezionata la prenotazione dell'intero campo
document.querySelectorAll('input[name="prenotazione"]').forEach(function(radio) {
  radio.addEventListener('change', function() {
    if (this.value === 'interoCampo') {
      document.getElementById('numPersoneWrapper').style.display = 'none';
    } else {
      document.getElementById('numPersoneWrapper').style.display = 'block';
    }
  });
});