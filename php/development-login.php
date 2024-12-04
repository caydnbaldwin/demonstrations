<?php
// initiates the parameters required to establish connection between php and mysql
$hostname = "localhost";
$username = "root";
$password = "";
$database = "authentication";
// opens a connection to mysql server
$connection = new mysqli($hostname, $username, $password, $database);

// checks for a connection error
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// retrieve the username and password input values from form submitted via POST method
$input_username = $_POST['username'];
$input_password = $_POST['password'];
// SQL query to select all columns from the 'users' table where the username matches the input username and the password matches
$sql = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";

// execute query
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // if admin, go to admin page
    if ($user['role'] === 'admin') {
        header("Location: database-admin.php");
        exit;
    // if user, go to user page
    } elseif ($user['role'] === 'user') {
        header("Location: ../html/database-user.html?username=" . $user['username']);
        exit;
    }
} else {
    header("Location: development.php?error=Invalid credentials");
    exit;
}

// kill connection
$connection->close();
?>