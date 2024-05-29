const searchBar = document.querySelector('.search input'),
      searchIcon = document.querySelector('.search button'),
      usersList = document.querySelector('.users-list');

// Event listener for clicking the search icon
searchIcon.onclick = () => {
    searchBar.classList.toggle('show'); 
    searchIcon.classList.toggle('active'); 
    searchBar.focus(); 
    if (searchBar.classList.contains('active')) {
        searchBar.value = ''; 
        searchBar.classList.remove('active'); 
    }
};

// Event listener for keyup event on the search bar
searchBar.onkeyup = () => {
    let searchTerm = searchBar.value; // Get the current value of the search bar
    if (searchTerm != '') {
        searchBar.classList.add('active'); // Add the active class if there's input
    } else {
        searchBar.classList.remove('active'); // Remove the active class if input is cleared
    }
    
    // Create a new AJAX request
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/search.php', true); // Open a POST request to the search script
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response; // Get the response from the server
                usersList.innerHTML = data; // Update the user list with the search results
            }
        }
    };
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); // Set the request header
    xhr.send('searchTerm=' + searchTerm); // Send the search term to the server
};

// Periodically update the user list every 500 milliseconds
setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/users.php', true); 
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response; 
                if (!searchBar.classList.contains('active')) { 
                    usersList.innerHTML = data; 
                }
            }
        }
    };
    xhr.send(); // Send the request
}, 500);
