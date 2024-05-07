// Funzione per mostrare o nascondere la descrizione del servizio
function toggleDescrizioneServizio(titolo, descrizione, immagine) {
  var descrizioneFissa = document.getElementById("descrizione-fissa");
  var titoloServizio = document.getElementById("titolo-servizio");
  var immagineServizio = document.getElementById("immagine-servizio");
  var descrizioneServizio = document.getElementById("descrizione-servizio");

  // Se il titolo è lo stesso del servizio aperto, chiudi il div fisso
  if (descrizioneFissa.dataset.servizio === titolo) {
      descrizioneFissa.style.display = "none";
      descrizioneFissa.dataset.servizio = "";
  } else {
      // Altrimenti, mostra il servizio e aggiorna il contenuto
      titoloServizio.textContent = titolo;
      immagineServizio.src = immagine;
      descrizioneServizio.innerHTML = descrizione; // innerHTML ancihè textContent per prendere anche i br
      descrizioneFissa.style.display = "block";
      descrizioneFissa.dataset.servizio = titolo;

      // Cambia lo stile del paragrafo
      descrizioneServizio.style.fontSize = "14px"; /* Cambia la dimensione del testo */
  }
}

// Aggiungi gestori di eventi ai titoli dei servizi
document.getElementById("bar-title").addEventListener("click", function() {
  toggleDescrizioneServizio("Bar", document.getElementById("bar-desc").innerHTML, "immagini/galleria/servizi/bar.jpg");
});
document.getElementById("pool-title").addEventListener("click", function() {
  toggleDescrizioneServizio("Piscina", document.getElementById("pool-desc").innerHTML, "immagini/galleria/servizi/pool.jpg");
});
document.getElementById("rec-title").addEventListener("click", function() {
  toggleDescrizioneServizio("Reception", document.getElementById("rec-desc").innerHTML, "immagini/galleria/servizi/reception.jpg");
});
document.getElementById("rest-title").addEventListener("click", function() {
  toggleDescrizioneServizio("Ristorante", document.getElementById("rest-desc").innerHTML, "immagini/galleria/servizi/restaurant.jpeg");
});