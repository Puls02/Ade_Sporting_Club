// se ci arrivi con un ancora il form si apre di default
document.addEventListener("DOMContentLoaded", function() {
  // Controlla se c'è un hash nell'URL
  const hash = window.location.hash;

  if (hash) {
      // Rimuovi il simbolo "#" dall'hash
      const targetId = hash.substring(1);

      // Trova l'input radio corrispondente e selezionalo
      const targetInput = document.getElementById(targetId);
      if (targetInput) {
          targetInput.checked = true;

          // Trova il contenuto associato e mostralo
          const targetContent = targetInput.querySelector(".content");
          if (targetContent) {
              targetContent.style.display = "block";
          }
      }
  }
});

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

document.addEventListener('DOMContentLoaded', function () {
  // Funzione per mostrare o nascondere il numPersoneWrapper
  function toggleNumPersoneWrapper(wrapper, show) {
    wrapper.style.display = show ? 'block' : 'none';
  }

  // Recupera tutti i form
  const forms = document.querySelectorAll('form[name="formPrenotazione"]');

  forms.forEach(form => {
    const numPersoneWrapper = form.querySelector('.numPersoneWrapper');
    const codaGiocoRadio = form.querySelector('input[value="codaGioco"]');
    const interoCampoRadio = form.querySelector('input[value="interoCampo"]');

    // Inizializza la visibilità
    toggleNumPersoneWrapper(numPersoneWrapper, false);

    // Aggiungi event listener per il click sui radio buttons
    codaGiocoRadio.addEventListener('click', function () {
      toggleNumPersoneWrapper(numPersoneWrapper, true);
    });

    interoCampoRadio.addEventListener('click', function () {
      toggleNumPersoneWrapper(numPersoneWrapper, false);
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
  });
});