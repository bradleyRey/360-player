var port = process.env.PORT || 3004;
var app = require('express')();
var server = app.listen(port);
var io = require('socket.io').listen(server);
var bodyParser = require('body-parser');
process.binding('http_parser').HTTPParser = require('http-parser-js').HTTPParser;
var http = require('http');


// Keeping track of clients
var clients = 0;


app.use(bodyParser.json());

app.use(bodyParser.urlencoded({
    extended: true
  }));




console.log('listening on port: ' + port)

app.post('/emit/answers/', function(req,res,err){
    console.log('A question has been answered, bringing it back to the front...');
    var ans = req.body.answer;
    var ques = req.body.question;
    var room = req.body.url;
    var post = req.body.post;
    console.log(ans);
    console.log("Emit rooms?");

    io.sockets.emit('answers', {ans,ques,post});
    console.log('emmitted the socket');
  res.send({
    'errors': err
  });
});


app.post('/emit/captions/', function(req,res,err){
    console.log('An image is being sent...');

    var img= req.body.image;
    var link = req.body.link;
    var tweet = req.body.tweet;
    var post = req.body.room;
    console.log('POST ID: ' + post);
    console.log( link + '...this is the link');
    console.log('And this is the tweet content' + tweet);

    io.sockets.emit('captions',{img,link,tweet,post});
    console.log('emmitted the socket to send a caption');
});

io.on('connection', (socket) => {
    socket.on('join-room', function (room){
        console.log('Joining Room...')
        socket.join(room);
        console.log('A user has joined room: ', room)
    });
    //Tracks how many users are connected to the ENTIRE system
    clients++;
    setTimeout(function () {
        io.sockets.emit('broadcast', {
            description: "There are currently " + clients + " active users!"
        });
        console.log('There are currently ' + clients + " client(s) in the chatroom")

    }, 4000);

    socket.on('disconnect', function () {
        clients--;
        io.sockets.emit('broadcast', {
            description: "A user has left. There are currently " + clients + ' active user(s)!'
        });
        console.log('Someone left. There are now ' + clients + ' users');
        });

    //Sends a message to the Chatroom 3 seconds after it has Connected
    setTimeout(function () {
        console.log('3 Seconds up, sending welcome messgae');
        socket.send('Welcome to the Chatroom! We hope you enjoy');
    }, 3000);
    console.log('A user has connected to the Chatroom');

    // Tracks messages sent
    socket.on('chat message', function (msg) {
        io.emit('chat message', msg);
        console.log('A user has sent the message: ' + msg);
        //Custom Events
        //This Event allows the user to quit the room by saying "quit"
        if (msg === 'quit') {
            console.log('Someone said quit');
            socket.emit('quit', {
                text: 'Are you sure you want to quit'
            }, function () {
                console.log('A user has entered quit, firing "quit" event');
                socket.on('disconnect', function () {
                    console.log('A user has disconnected from the Chatroom');
                });
            });
        };
    });
    /* Event to be emitted when the user asks a question,
    would like to eventually tag the user with it too.. */

    socket.on('question', function (data) {
        console.log('The question: ' + data + ' has been asked in room ' + socket.rooms);
//        socket.rooms.forEach(function (room) {
//            console.log("Room:", room)
//        });
    });
/*
    socket.on('answers', function(data){
        console.log('An answer has been submitted, sending it into the front: ');
        console.log();
    });*/

    //Event emitted when someone leaves the chat room
    socket.on('disconnect', function () {
        console.log('A user has disconnected from the Chatroom');
    });
});


