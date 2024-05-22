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
            
            // Check if the content is already visible
            if (content.style.display === 'block') {
                // Hide the content and reset the radio button
                content.style.display = 'none';
                this.checked = false;
            } else {
                // Hide all content divs
                document.querySelectorAll('.content').forEach(function(item) {
                    item.style.display = 'none';
                });

                // Show the current content div
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
  });
});
