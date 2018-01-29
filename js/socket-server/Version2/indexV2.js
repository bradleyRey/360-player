var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var port = process.env.PORT || 3005;

// Keeping track of clients
var clients = 0

app.get('/', function (req, res) {
    res.sendFile(__dirname + '/indexV2.html');

});
//Variables
var usernames = {}
var clients = 0
var room = io.of('/testroom');

room.on('connection', function (socket) {
    clients++
    console.log('someone connected to the chat');
    setTimeout(function () {
        io.sockets.emit('broadcast', {
            description: 'There are currently' + clients + 'active users!'
        });
        console.log('There are currently', clients, 'user(s)')
    }, 4000);

    setTimeout(function () {
        console.log('Sending a welcome message after 3 seconds...')
        socket.send('Welcome to the Aston Online Experience! You are now in an interactive environment with ' + ' <SPEAKER NAME>');
    }, 3000);

    socket.on('disconnect', function () {
        clients--;
        io.sockets.emit('broadcast', {
            description: "A user has left the chatroom, there are currently" + clients + 'user(s)'
        });
        console.log('A user has left the namespace, there are now', clients, 'user(s)')
    });

    socket.on('chat message', function (msg) {
        room.emit('chat message', msg);
        console.log('The message: ', msg, ' has been sent.');
    });
    socket.on('adduser', function (username) {
        socket.username = username;
        //Add to username list
        usernames[username] = username;
        console.log(usernames)

    });
});





http.listen(port, function () {
    console.log('listening on: ' + port);
});
