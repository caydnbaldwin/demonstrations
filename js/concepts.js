// initiate wordlist
let wordList = [];

// load the word list `word-list.txt` in the `assets` subdirectory
fetch('../assets/word-list.txt')
    .then(response => {
        return response.text();
    })
    .then(data => {
        // split the file into an array of words
        wordList = data.split('\n').map(word => word.trim());
    })
    .catch(error => console.error("Error loading dictionary:", error));

// get the slider and display element for dynamic updates
const slider = document.getElementById('wordCount');
const wordCountDisplay = document.getElementById('wordCountValue');

// update the displayed word count based on slider input
function updateWordCount(value) {
    wordCountDisplay.textContent = value;
}

// toggle visibility of leet code options
function toggleLeetOptions() {
    const leetOptions = document.getElementById('leetOptions');
    const toggleButton = document.getElementById('toggleLeetOptions');
    const arrow = toggleButton.querySelector('span');

    if (leetOptions.style.display === 'none' || leetOptions.style.display === '') {
        // show the advanced options and change arrow to up
        leetOptions.style.display = 'block';
        arrow.textContent = '▲';
    } else {
        // hide the advanced options and change arrow to down
        leetOptions.style.display = 'none';
        arrow.textContent = '▼';
    }
}

// generate a random passphrase based on the selected number of words
function generatePassphrase() {
    const numWords = parseInt(slider.value);
    let passphrase = [];

    // randomly select words from the list
    for (let i = 0; i < numWords; i++) {
        const randomIndex = Math.floor(Math.random() * wordList.length);
        let word = wordList[randomIndex];

        // if selected, capitalize
        if (document.getElementById('capitalizeWords')?.checked) {
            word = capitalizeWord(word);
        }
        //  if selected, numbers
        if (document.getElementById('includeNumbers')?.checked) {
            word = includeNumbers(word);
        }
        //  if selected, special characters
        if (document.getElementById('includeSpecialChars')?.checked) {
            word = includeSpecialChars(word);
        }

        passphrase.push(word);
    }

    // if selected, spaces
    const includeSpaces = document.getElementById('includeSpaces').checked;
    const separator = includeSpaces ? " " : "";

    // convert the passphrase array into a string and display it
    const passphraseString = passphrase.join(separator);
    document.getElementById("passphrase").textContent = passphraseString;
}

// capitalize
function capitalizeWord(word) {
    return word.charAt(0).toUpperCase() + word.slice(1);
}

// numbers
function includeNumbers(word) {
    const leetDict = { "a": "4", "b": "8", "e": "3", "o": "0", "s": "5", "t": "7" };
    return word.split('').map(char => leetDict[char.toLowerCase()] || char).join('');
}

// special characters
function includeSpecialChars(word) {
    const leetSpecialChars = { "a": "@", "4": "@", "h": "#", "i": "!", "s": "$", "5": "$" };
    return word.split('').map(char => leetSpecialChars[char.toLowerCase()] || char).join('');
}
