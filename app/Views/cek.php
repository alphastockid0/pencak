
<!DOCTYPE html>
<html>

<head>
    <title>Chat App</title>
    <style>
        #chat-box {
            width: 400px;
            height: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow: auto;
        }
    </style>
</head>

<body>
    <div id="chat-box"></div>
    <input type="text" id="message-input" placeholder="Tulis pesan...">
    <button onclick="sendMessage()">Kirim</button>

    <script>
        const socket = new WebSocket('http://192.168.1.62:8080');
        const chatBox = document.getElementById('chat-box');
        const messageInput = document.getElementById('message-input');

        // Menangani pesan yang diterima dari server
        socket.onmessage = function(event) {
            const message = event.data;
            chatBox.innerHTML += '<p>' + message + '</p>';
        };

        // Mengirim pesan ke server saat tombol "Kirim" ditekan
        function sendMessage() {
            const message = messageInput.value;
            socket.send(message);
            messageInput.value = '';
        }
    </script>
</body>

</html>