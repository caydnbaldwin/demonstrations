<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chat";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// initialize notification variable
$clear_success = false;

// clear chat
if (isset($_POST['clear_chat'])) {
    // clear chat table in MySQL database
    $sql = "DELETE FROM chats";
    if ($conn->query($sql) === TRUE) {
        // clear session and cookies
        session_start();
        session_unset();
        session_destroy();

        // set successful flat to true for notification
        $clear_success = true;

        // redirect to the same page to clear all scripts
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// insert message into database
if (isset($_POST['message'])) {
    $message = $_POST['message'];
    $stmt = $conn->prepare("INSERT INTO chats (messages) VALUES (?)");
    $stmt->bind_param("s", $message);
    $stmt->execute();
    $stmt->close();
}

// fetch messages for both regular page loads and AJAX requests
$sql = "SELECT * FROM chats ORDER BY timestamp ASC";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

// check if it's an AJAX request for loading messages
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    // output only the chat messages (no header, footer, or other sections)
    foreach ($messages as $message) {
        echo "<div class='chat-message'>";
        echo $message['messages'];
        echo "<span class='timestamp'>" . $message['timestamp'] . "</span>";
        echo "</div>";
    }
    exit; // end the script here for AJAX requests
}

// kill connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css stylesheets -->
    <link rel="stylesheet" href="../css/header-footer-button.css">
    <link rel="stylesheet" href="../css/development.css">
    <!-- window title -->
    <title>Demonstrations | Development | Sign In</title>

</head>

<body>

    <!-- header  -->
    <header id="menu">

        <!-- left side -->
        <div id="menu-item-1">
            <!-- `Demonstrations` links to `index.html` -->
            <a href="../index.html"><h3>Demonstrations</h3></a>
        </div>

        <!-- right side -->
        <div id="menu-item-2">
            <nav id="menu-item-2-nav">
                <!-- `Concepts` links to `concepts.html` in `html` subdirectory -->
                <a href="../html/concepts.html"><h3>Concepts</h3></a>
                <h3>|</h3>
                <!-- `Database` links to `database-login.html` in `html` subdirectory -->
                <a href="../html/database-login.html"><h3>Database</h3></a>
                <h3>|</h3>
                <!-- `Development` links to `development.php` in `php` subdirectory -->
                <a href="development.php"><h3>Development</h3></a>
            </nav>
        </div>

    </header>

    <!-- main content -->
    <section id="main-content">

        <!-- left side -->
        <div id="chat-section" class="left-section">
            <button id="clear-chat-button">Clear Chat</button>
            <h2>Chat</h2>

            <!-- chat box -->
            <div id="chat-box">
                <!-- php -->
                <?php foreach ($messages as $message): ?>
                    <div class="chat-message">
                        <p><?php echo $message['messages']; ?></p>
                        <span class="timestamp"><?php echo $message['timestamp']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- form -->
            <form id="chat-form" method="POST" action="">
                <input id="message-input" type="text" name="message" placeholder="Type your message here..." required>
                <button type="submit">Send</button>
            </form>
        </div>

        <!-- right side -->
        <div id="login-section" class="right-section">
            <h1>Login</h1>

            <!-- form inputs to submit with `database-login.php` to communicate with MySQL database -->
            <form action="development-login.php" method="POST">
                
                <!-- username -->
                <div class="form-item">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <!-- password -->
                <div class="form-item">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <!-- login button -->
                <button type="submit">Login</button>
            </form>
        </div>

    </section>

    <!-- Success Notification -->
    <?php if ($clear_success): ?>
        <div id="notification" class="notification show">
            Chat has been cleared successfully!
        </div>
    <?php endif; ?>

    <!-- footer  -->
    <footer>
        <p>Made from scratch by Caydn Baldwin utilizing HTML, CSS, JavaScript, PHP, SQL, Python, and VBA in Visual Studio Code</p>
    </footer>

    <!-- javascript -->
    <script src="../js/development.js"></script>
</body>
</html>
