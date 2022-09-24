import './bootstrap';
import axios from "axios";

window.addEventListener('load', (e) => {

    const input = document.querySelector('input');
    const messages = document.querySelector('#messages_list');

    handleLogin(input);

    input.addEventListener('keypress', function (e) {

        if (e.code === 'Enter') {

            handleSendMessage(input.value);

            // Clean input
            input.value = '';

        }

    });

});

const handleLogin = (input) => {

    const email = prompt('Email: ');
    const password = prompt('Password: ');

    axios.post('http://localhost:8000/login', {
        email: email,
        password: password
    })
        .then((response) => {
            input.disabled = false;
            input.placeholder = 'Type your message and press Enter';
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
    })
        .catch((error) => {
            alert(error.response.message)
        })

}

// ==== LARAVEL ECHO - EMISSIONS FROM SERVER DETECTION ==== //
window.Echo.channel('login').listen('authenticated', (e) => {

    const li = document.createElement("li");

    li.appendChild(document.createTextNode(e.message));
    messages.append(li);
});

window.Echo.channel('chat').listen('message', (e) => {

    console.log(e)

    const li = document.createElement("li");

    li.appendChild(document.createTextNode(e.message));
    messages.append(li);
});