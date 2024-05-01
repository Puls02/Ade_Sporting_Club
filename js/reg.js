function checkType(){    
    v=document.getElementById("abbonamento").value;
    if(v == ""){
        alert("Devi selezionaaare un tipo di abbonamento");
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
            if(checkbox.value=="palestra"){
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
            if(checkbox.value=="palestra"){
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
}

function resetCheckboxes(){
    checkboxes=document.querySelectorAll('input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked=false;
    })

}

function checkForm(event){
    if(document.getElementsByName('sesso')[0].checked==false && document.getElementsByName('sesso')[1].checked==false){
        event.preventDefault(); //blocca l'invio del modulo
        alert("Sesso mancante");
        return false;
    }

    checkboxes=document.querySelectorAll('input[type="checkbox"]');
    check=0;
    checkboxes.forEach(checkbox => {
        if(checkbox.checked==true){
            check++;
        }
    })

    if(check==0){
        event.preventDefault();
        alert("Non hai selezionato nessun corso");
        return false;
    }

    checkboxes[5].disabled=false;
}
