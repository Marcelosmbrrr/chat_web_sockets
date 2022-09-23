// Express
const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const path = require('path');
const http = require('http');
const { Server } = require("socket.io");

const app = express();

app.use(cors({
    origin: "localhost:3300"
}));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(express.static('public')); // static assets folder

// Create a HTTP server from Express to use its common functionalities
const serverHttp = http.createServer(app);

app.get('/', function (req, res) {
    res.sendFile(path.join(__dirname + '/public/index.html'));
});

serverHttp.listen(3300);

// ============= SOCKET IO - EMISSIONS FROM CLIENT DETECTION ============ //

// Create a socket server to use socket io functionalities
const serverSocket = new Server(serverHttp);

// When the connection is initiated...
serverSocket.on('connection', (socket) => {

    // Socket io emissions chaining with socket object

    // "Login" emission that comes from client with some data
    // Data: nickname typed in the chat
    socket.on('login', (nickname) => {

        // Create new socket nickname attribute
        socket.nickname = nickname;

        // Construct data to emission
        const data = {
            nickname: nickname,
            message: `${nickname} initiated a connection!`
        };

        // Emit to client with data
        serverSocket.emit('login', data);
    });

    // "New_Message" emission that comes from client with some data
    // Data: message typed in the chat 
    socket.on('new_message', (message_typed) => {

        // Construct data to emission
        const message = `${socket.nickname} : ${message_typed}`;

        // Emit to client
        serverSocket.emit("new_message", message);
    });

});

