<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/main_menu.css">
</head>
<body>
<h1>Create Discount Codes</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost";
    $username = "username"; // replace with your database username
    $password = "password"; // replace with your database password
    $dbname = "database_name"; // replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form data is set
    if (isset($_POST['promoCode']) && isset($_POST['validity']) && isset($_POST['discountType']) && isset($_POST['discountValue'])) {
        $promoCode = $_POST['promoCode'];
        $validity = $_POST['validity'];
        $discountType = $_POST['discountType'];
        $discountValue = $_POST['discountValue'];

        // Prepare SQL statement
        $sql = "INSERT INTO discount_codes (promoCode, validity, discountType, discountValue) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $promoCode, $validity, $discountType, $discountValue);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "New discount code created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        echo "Form data not set";
    }

    $conn->close();
}
?>

<form id="discountForm" method="post">
    <label for="promoCode">Promo Code:</label>
    <input type="text" id="promoCode" name="promoCode" required><br><br>

    <label for="validity">Validity Time:</label>
    <input type="datetime-local" id="validity" name="validity" required><br><br>

    <label for="discountType">Discount Type:</label>
    <select id="discountType" name="discountType" required>
        <option value="percentage">Percentage</option>
        <option value="amount">Amount</option>
    </select><br><br>

    <label for="discountValue">Discount Value:</label>
    <input type="number" id="discountValue" name="discountValue" required><br><br>

    <input type="submit" value="Create Promo Code">
</form>
</body>
</html>
