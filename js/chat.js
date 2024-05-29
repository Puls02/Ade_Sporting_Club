// Select the DOM elements needed for the chat
const form = document.querySelector('.typing-area'),
    incoming_id = form.querySelector('.incoming_id').value,
    inputField = form.querySelector('.input-field'),
    sendBtn = form.querySelector('button'),
    chatBox = document.querySelector('.chat-box');

// Prevents the default form submission behavior
form.onsubmit = (e) => {
    e.preventDefault();
};

// Set the focus to input field and it handles the activation of the submit button
inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != '') {
        sendBtn.classList.add('active'); 
    } else {
        sendBtn.classList.remove('active'); 
    }
};

// Manages clicking on the send button to send the message
sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest(); 
    xhr.open('POST', 'php/insert-chat.php', true); 
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputField.value = ''; // Clear the input field
                scrollToBottom(); 
            }
        }
    };
    let formData = new FormData(form); // Create a FormData with the form data
    xhr.send(formData); //Send the FormData to the server
};

// Adds 'active' class when mouse enters chat box
chatBox.onmouseenter = () => {
    chatBox.classList.add('active');
};

// Removes the 'active' class when the mouse leaves the chat box
chatBox.onmouseleave = () => {
    chatBox.classList.remove('active');
};

// Refresh chat every 500 milliseconds
setInterval(() => {
    let xhr = new XMLHttpRequest(); 
    xhr.open('POST', 'php/get-chat.php', true); 
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response; // Gets the response from the server
                chatBox.innerHTML = data; //Update the contents of the chat box
                if (!chatBox.classList.contains('active')) {
                    scrollToBottom(); // Scroll down in the chat if the user is not actively viewing
                }
            }
        }
    };
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
    xhr.send('incoming_id=' + incoming_id); //Send the incoming_id to the server
}, 500);

// Function to scroll down in the chat box
function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight; 
}
