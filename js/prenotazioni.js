// if you get there with an anchor the form opens by default
document.addEventListener("DOMContentLoaded", function() {
  // Check if there is a hash in the URL
  const hash = window.location.hash;

  if (hash) {
      //Remove the "#" symbol from the hash
      const targetId = hash.substring(1);

      // Find the corresponding radio input and select it
      const targetInput = document.getElementById(targetId);
      if (targetInput) {
          targetInput.checked = true;

          //Find the associated content and display it
          const targetContent = targetInput.querySelector(".content");
          if (targetContent) {
              targetContent.style.display = "block";
          }
      }
  }
});

//Close the form when clicking on the task
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
  // Function to show or hide the numPeopleWrapper
  function toggleNumPersoneWrapper(wrapper, show) {
    wrapper.style.display = show ? 'block' : 'none';
  }

  //Recover all forms
  const forms = document.querySelectorAll('form[name="formPrenotazione"]');

  forms.forEach(form => {
    const numPersoneWrapper = form.querySelector('.numPersoneWrapper');
    const codaGiocoRadio = form.querySelector('input[value="codaGioco"]');
    const interoCampoRadio = form.querySelector('input[value="interoCampo"]');

    //Initialize visibility
    toggleNumPersoneWrapper(numPersoneWrapper, false);

    //Add event listener for clicking on radio buttons
    codaGiocoRadio.addEventListener('click', function () {
      toggleNumPersoneWrapper(numPersoneWrapper, true);
    });

    interoCampoRadio.addEventListener('click', function () {
      toggleNumPersoneWrapper(numPersoneWrapper, false);
    });
    //Hide the Number of People field when booking the entire field is selected
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