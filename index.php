// index.php

<!DOCTYPE html>
<html>
<head>
    <title>Real-time Chat</title>
    <style>
        #chat-area {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="chat-area"></div>
    <input type="text" id="message-input" placeholder="Type your message">
    <button id="send-btn">Send</button>

    <script>
        const chatArea = document.getElementById('chat-area');
        const messageInput = document.getElementById('message-input');
        const sendButton = document.getElementById('send-btn');

        // Establish WebSocket connection
        const socket = new WebSocket('ws://localhost:8080');

        // Send message on button click
        sendButton.addEventListener('click', () => {
            const message = messageInput.value.trim();
            if (message !== '') {
                sendMessage(message);
                messageInput.value = '';
            }
        });

        // Send message on Enter key press
        messageInput.addEventListener('keypress', (event) => {
            if (event.key === 'Enter') {
                sendButton.click();
            }
        });

        // Handle received messages from server
        socket.addEventListener('message', (event) => {
            const message = event.data;
            displayMessage(message);
        });

        // Function to send message to server
        function sendMessage(message) {
            socket.send(message);
        }

        // Function to display message in the chat area
        function displayMessage(message) {
            const messageElement = document.createElement('div');
            messageElement.textContent = message;
            chatArea.appendChild(messageElement);
        }
    </script>
</body>
</html>
