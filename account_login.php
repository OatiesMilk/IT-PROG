<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/account_login.css">
</head>
<body>
    <?php
    // Start the session
    session_start();

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "machineproject");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        // Query the database for the user
        $query = "SELECT * FROM accounts WHERE username='$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Successful login
                $_SESSION['username'] = $username;
                header("Location: main_menu.php");
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
    mysqli_close($conn);
    ?>

    <div class="container">
        <h2>Login</h2>
        <?php
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="login_form">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
