document.getElementById('chat-form').addEventListener('submit', function (e) {
    e.preventDefault();

    // get the message input
    let message = document.getElementById('message-input').value;
    if (message.trim() !== "") {
        // send the message to the server via AJAX
        const formData = new FormData();
        formData.append('message', message);

        fetch('development.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // clear the message input
            document.getElementById('message-input').value = '';
            // reload the chatbox
            loadMessages();
        })
        .catch(error => console.error('Error:', error));
    }
});

// load messages from the server
function loadMessages() {
    fetch('development.php', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(data => {
        // update chatbox with the latest messages
        document.getElementById('chat-box').innerHTML = data;
    })
    .catch(error => console.error('Error loading messages:', error));
}

// initial load of messages once the page loads
window.onload = loadMessages;


// clear the chat
document.getElementById('clear-chat-button').addEventListener('click', function () {
    const formData = new FormData();
    formData.append('clear_chat', 'true');

    fetch('development.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // reload the chatbox after clearing
        loadMessages();
    })
    .catch(error => console.error('Error clearing chat: ', error));
});
