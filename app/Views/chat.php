<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Real-time Chat</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <h1>Real-time Chat</h1>
    <div id="chat"></div>
    <form id="message-form">
        <input type="text" id="message" autocomplete="off">
        <button>Send</button>
    </form>
    <script>
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            console.log(e.data);
            $('#chat').append('<p>' + e.data + '</p>');
        };

        $('#message-form').submit(function(e) {
            e.preventDefault();
            var message = $('#message').val();
            conn.send(message);
            $('#message').val('');
        });
    </script>
</body>
</html>
