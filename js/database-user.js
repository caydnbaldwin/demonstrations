const params = new URLSearchParams(window.location.search);
const username = params.get('username');

// insert username into window title
document.title = `Demonstrations | Database | ${username}`

// insert username into greeting
if (username) {
    const message = document.getElementById('message');
    message.style.fontSize = "24px";
    message.style.fontWeight = "bold";
    message.style.color = "white";
    message.textContent = `Welcome, ${username}!`;
}