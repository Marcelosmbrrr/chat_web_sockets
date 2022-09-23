import './bootstrap';
import axios from "axios";

window.addEventListener('load', (e) => {

    handleLogin();

    const input = document.querySelector('input');
    const messages = document.querySelector('#messages_list');

    input.addEventListener('keypress', function (e) {

        if (e.code === 'Enter') {

            handleSendMessage(input.value);

            // Clean input
            input.value = '';

        }

    });

});

const handleLogin = () => {

    const username = prompt('Username: ');
    const password = prompt('Password: ');

    axios.post('http://localhost:8000/login', {
        username: username,
        password: password
    })
        .then((response) => {
            alert(response.data.message);
        })
        .catch((error) => {
            alert(error.response.data.message);
            handleLogin();
        });

}

const handleSendMessage = (message) => {

    // Emit to server with data
    axios.post('http://localhost:8000/send-message', {
        message: message
    });

}

// ==== LARAVEL ECHO - EMISSIONS FROM SERVER DETECTION ==== //
window.Echo.channel('chat').listen('.message', (e) => {

    const li = document.createElement("li");

    li.appendChild(document.createTextNode(`${e.username}: ${e.message}`));
    messages.append(li);
})