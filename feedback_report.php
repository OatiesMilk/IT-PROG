<?php include 'db_connect.php'; ?>

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
    <p>Collects and compiles feedback and ratings from people who have attended events, as well as similar stakeholders as needed. Allows administrators to identify areas for improvement and address any issues raised by users.</p>

    <!-- Filter Form -->
    <form method="GET" action="">
        <label for="eventFilter">Filter by Event:</label>
        <input type="text" id="eventFilter" name="eventFilter" value="<?php echo htmlspecialchars($eventFilter); ?>">
        <button type="submit">Filter</button>
    </form>

    <h2>Feedback Summary</h2>
    <table>
        <tr>
            <th>Event</th>
            <th>Rating</th>
            <th>Comments</th>
        </tr>
        <?php
        // Filter feedback based on the event name provided in the filter form
        $eventFilter = isset($_GET['eventFilter']) ? $_GET['eventFilter'] : '';
        $sql = "SELECT event, rating, comments FROM feedback WHERE event LIKE '%$eventFilter%'";
        $result = $conn->query($sql);

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

    <!-- Buttons for additional functionalities -->
    <button onclick="window.location.href='download_report.php'">Download Report</button>
    <button onclick="window.location.href='detailed_feedback.php'">View Detailed Feedback</button>
</body>
</html>

<?php
$conn->close();
?>
