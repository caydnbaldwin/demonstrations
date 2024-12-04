<?php
// db_connection.php
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

// run the DELETE query to clear the chats table
$sql = "DELETE FROM chats";
if ($conn->query($sql) === TRUE) {
    echo "Chats cleared successfully.";
} else {
    echo "Error: " . $conn->error;
}

// close the connection
$conn->close();
?>