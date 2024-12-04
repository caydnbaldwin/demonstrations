<?php
// initiate the parameters required to establish connection between php and mysql
$hostname = "localhost";
$username = "root";
$password = "";
$database = "authentication";
// open a connection to mysql server
$connection = new mysqli($hostname, $username, $password, $database);

// check for a connection error
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

    if ($user['role'] === 'admin') {
        header("Location: ../php/database-admin.php");
        exit;
    } elseif ($user['role'] === 'user') {
        header("Location: ../html/database-user.html?username=" . $user['username']);
        exit;
    }
} else {
    header("Location: ../html/database-login.html?error=Invalid credentials");
    exit;
}

// kill connection
$connection->close();
?>