# Demonstrations
This file contains step-by-step instructions to run the demonstrations with the website. It contains three steps:

&rarr; [Concepts](#concepts)

&rarr; [Database](#database)

&rarr; [Development](#development)

You are done after learning and running through each demonstration. Return to [INSTRUCTIONS.md](INSTRUCTIONS.md) or [README.md](../README.md).

## Concepts
`Concepts` is a simple demonstration. Security begins on an individual level. The [NIST Cybersecurity Framework (NIST CSF) Special Publication 800-63B](https://pages.nist.gov/800-63-3/sp800-63-3.html) teaches the importance of converting individual authentication credentials from passwords to passphrases. And defines a passphrase as "a memorized secret consisting of a sequence of words or other text that a claimant uses to authenticate their identity. A passphrase is similar to a password in usage, but is generally longer for added security." To demonstrate the importance and simplicity of good personal security and encourage compliance, students are encouraged to create a more secure authorization credential utilizing the [passphrase generator](../html/concepts.html).

1. Navigate to [`concepts.html`](../html/concepts.html).

2. Use the slider to indicate the number of words desired in the passphrase.

3. Because every login has different requirements, the `Advanced Options` button enables users to select more verbose requirements. If clicked, the user may choose to `Include spaces between words`, `Capitalize each word`, `Include numbers in words`, `Include special characters in words`.

4. After toggling `Advanced Options`, click `Generate Passphrase` to generate the passphrase. It will be output right below the button. 

## Database
`Database` is a simple demonstration. It is designed to spark interest in students for how practical security it. It is fascinating to learn how to break into websites or access accounts that you should not access. On a more serious note, Injection is still identified as a top risk by the [OWASP Top Ten](https://owasp.org/www-project-top-ten/). It is a common focus in security frameworks such as OWASP, NIST, and PCI DSS. This demonstration is to walk through the most traditional and simplistic version of a SQL injection.

1. Navigate to [`database-login.html`](../html/database-login.html).

2. Show that it is a website with user endpoints and admin endpoints.

    ### User
    
    1. Type `user` into the `Username` input box.

    2. Type `password` into the `Password` input box.

    3. Explain that this is a user endpoint. When you log in to a website or an app, you will see the user endpoint. In this example site, there is nothing but a greeting, but other platforms like Instagram will land you on your home page or feed.

    &rarr; Additional Note: Explain how the password `password` is the most commonly used password in the world and is incredibly insecure because it exists in wordlists like `RockYou.txt` along with millions of other common passwords.

    ### Admin

    1. Type `admin` into the `Username` input box.

    2. Type `super secure password` into the `Password` input box.

    3. Explain that this is an admin endpoint. You likely have never seen an admin endpoint before. They will typically contain dashboards along with more privileged and sensitive information.

    &rarr; Additional Notes: Explain how passphrases increase security and are much less likely to appear on password cracking wordlists.

    ### Injection

    1. Our goal is to access the admin endpoint without knowing the password. Type `admin` into the `Username` input box.

    2. Type `' OR TRUE -- ` into the `Password` input box.

    3. Explain that this is the same admin endpoint that we just accessed.

    &rarr; Additional Notes: Show line 19 of [`database-login.php](../php/database-login.php) where the SQL query is executed in a SQL editor like `Visual Studio Code` or `Data.world`. Type the injection into the query before the `$input_password` and watch what it does. Note how it prematurely closes the quote and then makes the password condition evaluate to `TRUE`, then comments the rest of the line out. Here is an example: 
    
    `$sql = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";` &rarr; `$sql = "SELECT * FROM users WHERE username = '$input_username' AND password = '' OR TRUE -- $input_password'";`

## Development
Development consists of two parts. The [first part](#redirect) is a more playful, light-hearted and simple demonstration that involves simplistic cross-site scripting (XSS). The goal is to "Rickroll" the students and make them laugh. The second part is a more serious and complex demonstration that involves complex XSS. The goal is the scare the students of the capabilities of hackers. XSS is another form of injection, similar to SQL injection. Unlike sql injection, which involves manipulating and exploiting databases, XSS manipulates and exploits posts and chats. It is just as prevelant as SQL injection but arguably more dangerous.

### Redirect
1. Navigate to [`development.php`](../php/development.php).

2. Type a few random prompts into the chat on the left and explain how it is just like Facebook or Instagram.

3. Open [`xss-redirect.xlsm`](../vba/xss-redirect.xlsm).

4. There should be a yellow security warning that says `Macros have been disabled` directly above the top row of cells with an `Enable Content` button. Click `Enable Content`.

5. Click `Send Malicious Request`.

6. Refresh the `development.php` page.

7. Explain how the `Send Malicious Request` entered a malicious script into the chat that broke the page and made it automatically redirect to the rickroll endlessly. Feel free to click on other tabs within the website and then try to revisit the `Development` tab to show that it is permanently destroyed. Feel free to open a new website in the current tab and then travel back. The website will still be broken.

8. Open `XAMPP Control Panel` as administrator. Click `Shell`. Run the following command `mysql -u root < .\htdocs\root\assets\show-malicious-scripts.sql`. Show that you can see the redirect script in the database.

9. Open `.\root\python` subdirectory in the terminal.

10. Type `.\.venv\Scripts\activate` to start the virtual environment.

11. Run [`development-recovery.py`](../python/development-recovery.py) to fix the broken website.

### Keylogger
1. Navigate to [`development.php`](../php/development.php).

2. Type a few random prompts into the chat on the left and explain how it is just like Facebook or Instagram.

3. Open [`xss-keylogger.xlsm`](../vba/xss-keylogger.xlsm).

4. There should be a yellow security warning that says `Macros have been disabled` directly above the top row of cells with an `Enable Content` button. Click `Enable Content`.

5. Click `Send Malicious Request`.

6. Refresh the `development.php` page.

7. Open `XAMPP Control Panel` as administrator. Click `Shell`. Run the following command `mysql -u root < .\htdocs\root\assets\show-malicious-scripts.sql`. You can see the keylogger script in the database.

8. Run [`keylogger-server.py`](../python/keylogger-server.py) to initiate the keylogger listening server.

    &rarr; If it doesn't work, change the port on line 29 to a port that is not in use.

9. Split your screen with the `xss-keylogger.xlsm` on the left and the `developent.php` on the right.

10. Click the `Start Live Keylogger` button in the `xss-keylogger.xlsm` file.

11. Type `username` into the `Username` input box on the `developent.php` page.

12. Type `password` into the `Password` input box on the `development.php` page.

13. Wait three to four seconds and you will see that whatever you type will appear in column `B` of the excel spreadsheet. Feel free to type anything you want now and wait a few seconds.

14. Press `Ctrl + C` in the terminal that you ran `keylogger-server.py` or just close the temrinal to kill the server.

15. Press `ESC` or close the excel file to kill the script. If the script persists and excel refuses to close, it will eventually time out after about a minute.

16. Click the `Clear Chat` button on the `development.php` page to remove the malicious script.

[&uarr; Back to top &uarr;](DEMONSTRATIONS.md#demonstrations)