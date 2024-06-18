<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/account_creation.css">
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
        // Collect and sanitize input data
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_BCRYPT); // Hash the password
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $mobile_num = mysqli_real_escape_string($conn, $_POST['mobile_num']);

        // Get the current max account_id
        $result = mysqli_query($conn, "SELECT MAX(account_id) AS max_id FROM accounts");
        $row = mysqli_fetch_assoc($result);
        $new_account_id = $row['max_id'] + 1;

        // Insert data into the database with the new account_id
        $sql = "INSERT INTO accounts (account_id, username, password, firstname, lastname, email, mobile_num) VALUES ('$new_account_id', '$username', '$password', '$firstname', '$lastname', '$email', '$mobile_num')";

        if (mysqli_query($conn, $sql)) {
            echo "New account created successfully.";
            // Redirect to the login page after successful registration
            header("Location: account_login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <div class="container">
        <h2>Create Account</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="register_form">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="mobile_num">Mobile Number:</label>
            <input type="tel" id="mobile_num" name="mobile_num" required>

            <input type="submit" value="Create Account">
        </form>
    </div>
</body>
</html>
