//Function to show or hide the service description
function toggleDescrizioneServizio(titolo, descrizione, immagine) {
  var descrizioneFissa = document.getElementById("descrizione-fissa");
  var titoloServizio = document.getElementById("titolo-servizio");
  var immagineServizio = document.getElementById("immagine-servizio");
  var descrizioneServizio = document.getElementById("descrizione-servizio");

  //If the title is the same as the open service, close the fixed div
  if (descrizioneFissa.dataset.servizio === titolo) {
      descrizioneFissa.style.display = "none";
      descrizioneFissa.dataset.servizio = "";
  } else {
      //Otherwise, show the service and update the content
      titoloServizio.textContent = titolo;
      immagineServizio.src = immagine;
      descrizioneServizio.innerHTML = descrizione; //innerHTML also textContent to also take the br
      descrizioneFissa.style.display = "block";
      descrizioneFissa.dataset.servizio = titolo;

      //Change the paragraph style
      descrizioneServizio.style.fontSize = "14px"; /* Change the text size */
  }
}

//Add event handlers to service titles
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