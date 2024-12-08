# Initiate
This file contains step-by-step instructions to host this website locally from scratch. It contains four steps:

&rarr; [Setup `XAMPP`, `Apache`, `MySQL`, and `PHP`](#setup-xampp-apache-mysql-and-php)

&rarr; [Setup `Demonstrations`](#setup-demonstrations)

&rarr; [Setup `authentication` and `chats` databases](#setup-authentication-and-chats-databases)

&rarr; [Setup `xss-redirect.xlsm` and `xss-keylogger.xlsm` malicious scripts](#setup-xss-redirectxlsm-and-xss-keyloggerxlsm-malicious-scripts)

Once completed, the entire website should be fully functional. Then proceed to the [next step](INSTRUCTIONS.md#demonstration.md).

## Setup `XAMPP`, `Apache`, `MySQL`, and `PHP`
1. Download [XAMPP](https://www.apachefriends.org/).

2. Run the installer .
    
    &rarr; Ensure `Apache`, `MySQL`, and `PHP` are checked.
3. Open `XAMPP Control Panel` as administrator.

4. Click `Start` next to `Apache` and `MySQL`.

    &rarr; The status should turn green if they start successfully.

    &rarr; If there is an error, ensure that no other service is using port 80 or 443 for `Apache`, or port 3306 for `MySQL`. You may need to change the default ports in the configuration files which can be found in the `Config` button on the `XAMPP Control Panel`.
5. Open a browser and go to `http://localhost`.

6. You will see the [XAMPP dashboard](http://localhost/dashboard/) if XAMPP is running correctly.

## Setup `Demonstrations`
1. Download [Demonstrations](https://insert_link_here.org).

2. Before extracting content, rename the zip file as `root`.

2. Place the `root` directory in `/xampp/htdocs` directory.

3. Open a browser and go to `http://localhost/root/index.html`.

4. You will see the `Demonstrations` home page if everything is working correctly.

    &rarr; Some of the PHP pages will not work yet because the database does not exist yet.

## Setup `authentication` and `chats` databases
1. If not already open, open `XAMPP Control Panel` as administrator.

2. Click `Shell` button.

3. Type `mysql -u root < .\htdocs\root\assets\setup-databases.sql` into the shell.
    
    &rarr; All of the PHP pages should work now.
    
    &rarr; If there is an error, it could be due to not entering the `-p` flag in the command. Try again with the flag inserted like this: `mysql -u root -p < .\htdocs\root\assets\setup-databases.sql`.

## Setup `xss-redirect.xlsm` and `xss-keylogger.xlsm` malicious scripts
1. Open `File Explorer`.

2. Navigate to `.\root\vba`.

3. Right click on `xss-redirect.xlsm`.

4. Click `Properties`.

5. Click `Unblock`.

6. Repeat for `xss-keylogger.xlsm`.

[&uarr; Back to top &uarr;](INITIATE.md#initiate)