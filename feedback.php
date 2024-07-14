<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "feedback_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT event, rating, comments FROM feedback";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Report</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/main_menu.css">
</head>
<body>
    <h1>Feedback Report</h1>
    <p>Collects and compiles feedback and ratings from people who have attended events, as well as with similar stakeholders as needed. Allows administrators to identify areas for improvement and address any issues raised by users.</p>

    <h2>Feedback Summary</h2>
    <table>
        <tr>
            <th>Event</th>
            <th>Rating</th>
            <th>Comments</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["event"]. "</td><td>" . $row["rating"]. "</td><td>" . $row["comments"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No feedback available</td></tr>";
        }
        ?>
    </table>

    <h2>Areas for Improvement</h2>
    <p>Insert summary of areas that need improvement based on the feedback collected.</p>
</body>
</html>

<?php
$conn->close();
?>
