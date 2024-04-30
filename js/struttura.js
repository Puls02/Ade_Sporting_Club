/* gestisce i vari servizi */
document.addEventListener('DOMContentLoaded', function() {
    // Crea il riquadro di descrizione
    var descriptionBox = document.createElement('div');
    descriptionBox.id = 'description-box';
    document.body.appendChild(descriptionBox);
  
    // Variabile per tenere traccia dell'elemento attualmente aperto
    var currentOpenId = null;
  
    // Funzione per mostrare o nascondere la descrizione
    function toggleDescription(event) {
      var descId = event.target.id.replace('-title', '-desc');
      var descText = document.getElementById(descId).textContent;
  
      // Controlla se l'elemento cliccato è già aperto
      if (currentOpenId === descId) {
        descriptionBox.style.display = 'none'; // Nasconde il riquadro
        currentOpenId = null; // Resetta l'elemento aperto
      } else {
        descriptionBox.textContent = descText;
        descriptionBox.style.display = 'block'; // Mostra il riquadro
        currentOpenId = descId; // Aggiorna l'elemento aperto
      }
    }
  
    // Aggiungi l'evento di clic ai titoli
    var titles = document.querySelectorAll('.service h2');
    titles.forEach(function(title) {
      title.addEventListener('click', toggleDescription);
    });
  });