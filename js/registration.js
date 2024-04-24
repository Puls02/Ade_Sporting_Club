function checkType(){
    v=document.getElementById("abbonamento").value;
    if(v == ""){
        alert("Devi selezionare un tipo di abbonamento");
        return false
    }
}

function checkSubscription(){
    checkLevel=document.getElementById("listastatus").value;
    checkboxes=document.querySelectorAll("input[type='checkbox'][name='corso']");
    if(checkLevel==""){
        checkboxes.forEach(checkbox => {
            if(checkbox.checked){
                checkbox.checked=false;
            }
        });
        alert("Devi selezionare il livello di abbonamento");
        return false;
    }

    

    
}