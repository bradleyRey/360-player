<!doctype html>
<html lang='en'>

<head>
    <title>Socket.IO chat</title>
    <meta charset="utf-8" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font: 13px Helvetica, Arial;
        }

        form {

            padding: 3px;
            position: fixed;
            bottom: 0;
            width: 100%;

        }

        form input {

            padding: 10px;
            width: 90%;
            margin-right: .5%;
        }

        form button {
            width: 9%;
            background: #0e8599;
            border: none;
            height: 37px;
            padding: 10px;
            color: white;
        }

        #messages {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #messages li {
            padding: 5px 10px;
        }

        #messages li:nth-child(odd) {
            background: #eee;
        }

        #messages {
            margin-bottom: 40px
        }

    </style>

</head>

    <body>
       <div>
           <input type="text" placeholder="Please enter a username...">
       </div>
        <ul id="messages"></ul>
        <form action="">
            <input id="m" autocomplete="off" /><button>Send</button>
        </form>
        <script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
        <script src="https://code.jquery.com/jquery-1.11.1.js"></script>
        <script>
            $(function() {

                var socket = io('/testroom');
                $('form').submit(function() {
                    socket.emit('chat message', $('#m').val());
                    $('#m').val('');
                    return false;
                });
                socket.on('chat message', function(msg) {
                    $('#messages').append($('<li>').text(msg));
                    window.scrollTo(0, document.body.scrollHeight);
                });
                socket.on('message', function(data) {
                    $('#messages').append($('<li>').text(data));
                });
                // Quit event (still needs completing)
                socket.emit('quit', function(data) {
                    $('#messages').append($('<li>').text(data.text));
                });
                socket.on('broadcast', function(data) {
                        console.log('testing123')
                    $('#messages').append($('<li>').text(data.description));
                });
                socket.on('test',function(data){
                    $('#messages').append($('<li>').text(data));
                });
            });
        </script>
        <script>



        </script>

    </body>

</html>
