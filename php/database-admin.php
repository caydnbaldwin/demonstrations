<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css stylesheets -->
    <link rel="stylesheet" href="../css/header-footer-button.css">
    <link rel="stylesheet" href="../css/database-admin.css">
    <!-- window title -->
    <title>Demonstrations | Database | Admin</title>

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

    <!-- greeting and database -->
    <section id="message">
        <h1>Welcome, Admin!</h1>

        <div class="erd-unit">
            <h3>Users Table</h3>

            <!-- users database table -->
            <table>
                <!-- table head -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Email</th>
                    </tr>
                </thead>

                <!-- table body -->
                <tbody>
                    <?php
                    // database connection
                    $hostname = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "authentication";
                    $connection = new mysqli($hostname, $username, $password, $database);

                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    // SQL query to get all rows from the `users` table
                    $sql = "SELECT * FROM users";
                    $result_users = $connection->query($sql);

                    if ($result_users->num_rows > 0) {
                        // output each row in a table
                        while ($row = $result_users->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['password'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="erd-unit">
            <h3>User SPII Table</h3>

            <!-- user spii table -->
            <table>
                <!-- table head -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>SSN</th>
                        <th>Credit Card</th>
                        <th>Expiration</th>
                        <th>Billing Address</th>
                        <th>DOB</th>
                    </tr>
                </thead>

                <!-- table body -->
                <tbody>
                    <?php
                    // SQL query to get all rows from the `user spii` table
                    $sql_spii = "SELECT * FROM user_SPII";
                    $result_spii = $connection->query($sql_spii);

                    if ($result_spii->num_rows > 0) {
                        // output each row in a table
                        while ($row = $result_spii->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['social_security_number'] . "</td>";
                            echo "<td>" . $row['credit_card_number'] . "</td>";
                            echo "<td>" . $row['expiration_date'] . "</td>";
                            echo "<td>" . $row['billing_address'] . "</td>";
                            echo "<td>" . $row['date_of_birth'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No SPII data found</td></tr>";
                    }
                    // kill database connection
                    $connection->close();
                    ?>
                </tbody>
            </table>
        </div>

    </section>

    <!-- footer  -->
    <footer>
        <p>Made from scratch by Caydn Baldwin utilizing HTML, CSS, JavaScript, PHP, SQL, Python, and VBA in Visual Studio Code</p>
    </footer>

    <!-- javascript -->
    <script src="../js/database-admin.js"></script>

</body>

</html>