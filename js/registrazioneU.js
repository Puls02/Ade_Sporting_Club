// courses or individual reservations: if you click on reservations the fields for the courses will be disabled, if you click on courses the choice for the category will become mandatory
function toggleFields() {
    const corsoCampo = document.querySelector('input[name="corso_campo"]:checked').value;
    const formFields = document.querySelectorAll('#abbonamento, #listastatus, input[name="corso[]"], #identity, #certmed');
    const categoriaFields = document.querySelectorAll('input[name="categoria"]');

    formFields.forEach(field => {
        if (corsoCampo === 'campo') {
            field.disabled = true;
            if (field.type === 'select-one' || field.type === 'select-multiple') {
                field.selectedIndex = 0;
            } else if (field.type === 'radio' || field.type === 'checkbox') {
                field.checked = false;
            } else if (field.type === 'file') {
                field.value = '';
            } else {
                field.value = '';
            }
        } else {
            field.disabled = false;
        }
    });

    categoriaFields.forEach(field => {
        if (corsoCampo === 'campo') {
            field.disabled = true;
            field.required = false;
            field.checked = false;
        } else {
            field.disabled = false;
            field.required = true;
        }
    });
}

//if you choose the courses
function checkType(){    
    v=document.getElementById("abbonamento").value;
    if(v == ""){
        alert("Devi selezionare un tipo di abbonamento");
        return false
    }
}

function checkSubscription(event){
    checkLevel=document.getElementById("listastatus").value;
    checkboxes=document.querySelectorAll('input[name="corso[]"]');
    checkboxes[5].disabled=true;

    if(checkLevel==""){
        box=event.target;
        box.checked=false;
        alert("Devi selezionare il livello di abbonamento");
        return false;
    }
    
    let selected=0;

    checkboxes.forEach(checkbox => {
        if(checkbox.checked){
            selected++;
        }
    })

    if(checkLevel=="single"){
        if(selected>1){
            box=event.target;
            box.checked=false;
            alert("Con l'abbonamento singolo puoi selezionare un solo corso");
            return false;
        }
    }

    if(checkLevel=="double"){
        if(selected>2){
            box=event.target;
            box.checked=false;
            alert("Con l'abbonamento doppio puoi selezionare solo due corsi");
            return false;
        }
    }

    if(checkLevel=="gym"){
        checkboxes.forEach(checkbox => {
            if(checkbox.value=="Palestra"){
                checkbox.checked=true;
            }
        })
        box=event.target;
        box.checked=false;
        alert("Con l'abbonamento palestra non puoi accedere ai corsi");
        return false;
    }

    if(checkLevel=="opengym"){
        checkboxes.forEach(checkbox => {
            if(checkbox.value=="Palestra"){
                checkbox.checked=true;
            }
        })
        if(selected>2){
            box=event.target;
            box.checked=false;
            alert("Con l'abbonamento palestra open puoi accedere solo ad un corso");
            return false;
        }
        
    }

    if(checkLevel=="gold"){
        checkboxes.forEach(checkbox => {
            if(checkbox.value=="Palestra"){
                checkbox.checked=true;
            }
        })
        if(selected>2){
            box=event.target;
            box.checked=false;
            alert("Con l'abbonamento gold puoi accedere solo ad un corso");
            return false;
        }
    }
}

function resetCheckboxes(){
    checkboxes=document.querySelectorAll('input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked=false;
    })

}

function checkForm(event) {
    if (document.getElementsByName('sesso')[0].checked == false && document.getElementsByName('sesso')[1].checked == false) {
        event.preventDefault(); // blocca l'invio del modulo
        alert("Sesso mancante");
        return false;
    }

    // Abilita la casella di controllo "Palestra" prima della presentazione del modulo
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        if (checkbox.value === 'Palestra') {
            checkbox.disabled = false;
        }
    });

    // Controlla se il tipo di abbonamento è selezionato se si sceglie di sottoscrivere un abbonamento
    let radioCorso = document.querySelector('input[name="corso_campo"][value="corso"]');
    if (radioCorso.checked) {
        let check = 0;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked == true) {
                check++;
            }
        });

        // Se nessuna casella di controllo è selezionata e il pulsante di opzione è selezionato, impedisce l'invio del modulo
        if (check == 0) {
            event.preventDefault();
            alert("Non hai selezionato nessun corso");
            return false;
        }
    }
    checkboxes.disabled=false;
    // Se hai bisogno di aggiungere del codice, aggiungilo sopra questa riga
}



function checkRegistration(){
    corso_campo=document.getElementsByName("corso_campo");
    for (var i = 0; i < corso_campo.length; i++) {
        if (corso_campo[i].checked && corso_campo[i].value === 'campo') {
            alert("Non puoi sottoscrivere un abbonamento se desideri prenotare soltanto i campi");
            return false;
        }
    }
}

