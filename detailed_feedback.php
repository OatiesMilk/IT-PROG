<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Feedback</title>
    <link rel="stylesheet" href="/IT-PROG/MP/css/main_menu.css">
</head>
<body>
    <h1>Detailed Feedback</h1>
    <table>
        <tr>
            <th>Event</th>
            <th>Rating</th>
            <th>Comments</th>
        </tr>
        <?php
        $sql = "SELECT event, rating, comments FROM feedback";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["event"]. "</td><td>" . $row["rating"]. "</td><td>" . $row["comments"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No detailed feedback available</td></tr>";
        }
        ?>
    </table>
    <p>Additional details and analysis can be added here.</p>
    <!-- Back Button -->
    <button onclick="window.location.href='main_feedback_report.php'">Back to Feedback Report</button>
</body>
</html>

<?php
$conn->close();
?>
